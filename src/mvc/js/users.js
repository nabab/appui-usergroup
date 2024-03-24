(() => {
  return {
    props: ['source'],
    data(){
      return {
        root: appui.plugins['appui-usergroup'] + '/',
        user: appui.user,
        connection:[{
          text: bbn._('Connected'),
          value: true
        },{
          text: bbn._('Disconnected'),
          value: false
        }]
      }
    },
    computed: {
      themes() {
        return this.source.themes;
      }
    },
    methods: {
      trClass(row){
        return 'valignm';
      },
      renderUsername(row){
        let isAdmin = !!row[this.source.arch.admin];
        return `<span class="${isAdmin ? 'bbn-b' : ''}">${row[this.source.arch.username]}</span>`;
      },
      renderTel(row){
        return row[this.source.arch.phone] || '-';
      },
      renderFonction(row){
        return row[this.source.arch.fonction] || '-';
      },
      renderSession(row){
       return `<span class="${row.session ? 'bbn-green' : 'bbn-red'}">${row.session ? bbn._('Connected') : bbn._('Disconnected')}</span>`;
      },
      renderLastActivity(row){
        return row.last_activity ? dayjs(row.last_activity).format('DD/MM/YYYY HH:mm') : '';
      },
      disconnectUser(row){
        let table = this.$refs.table;
        this.post(this.root + 'actions/sessions/close', {
          id: row.id,
          minutes: 2
        }, d => {
          if ( d.success ){
            row.session = false;
            appui.success(bbn._("Disconnected"));
            this.$nextTick(() => {
              table.$forceUpdate();
            });
          }
          else{
            appui.error(bbn._("No session"));
          }
        })
      },
      getButtons(row){
        let btn = [{
          text: bbn._('Disconnect'),
          notext: true,
          action: this.disconnectUser,
          icon: 'nf nf-fa-eject',
          disabled: !!(
            !row.session ||
            (
              ((row[this.source.arch.admin] || row[this.source.arch.dev]) && !this.user.isAdmin) ||
              (this.user.isDev && !this.user.isAdmin)
            )
          )
        }, {
          text: bbn._('Edit'),
          notext: true,
          action: this.edit,
          icon: 'nf nf-fa-edit',
          disabled: !this.source.permissions.update
        }, {
          text: bbn._('Delete'),
          notext: true,
          action: this.remove,
          icon: 'nf nf-fa-trash',
          disabled: !this.source.permissions.delete
        }];
        if ( this.source.perm_root ){
          btn.push({
            text: bbn._('Permissions'),
            notext: true,
            action: this.permissions,
            icon: 'nf nf-fa-key',
            disabled: !this.source.permissions.permissions
          });
        }
        btn.push({
          text: bbn._('Re-initialize'),
          notext: true,
          action: this.init,
          icon: 'nf nf-fa-envelope',
          disabled: !this.source.permissions.init
        });
        return btn;
      },
      insert(){
        if (!!this.source.permissions.insert) {
          this.$refs.table.insert({}, {
            title: bbn._("New user"),
            width: 450,
            height: 400
          });
        }
      },
      edit(row){
        if (!!this.source.permissions.update
          && (!row[this.source.arch.dev] || this.user.isAdmin)
        ) {
          this.$refs.table.edit(row, {
            title: bbn._("User edit"),
            width: 450,
            height: 400
          });
        }
      },
      remove(row){
        if (row[this.source.arch.id]
          && !row[this.source.arch.admin]
          && (!row[this.source.arch.dev] || this.user.isAdmin)
          && !!this.source.permissions.delete
        ){
          this.confirm(bbn._("Are you sure you want to delete this user?"), () => {
            this.post(this.root + "actions/users/delete", {id: row[this.source.arch.id]}, (d) => {
              if ( d.success ){
                let idx = bbn.fn.search(this.source.users, this.source.arch.id, row[this.source.arch.id]);
                if ( idx > -1 ){
                  this.source.users.splice(idx, 1);
                  this.$refs.table.updateData();
                  appui.success(bbn._('Deleted'));
                }
              }
              else {
                appui.error(bbn._('Error!'));
              }
            });
          });
        }
      },
      permissions(row){
        if ( this.source.perm_root && row.id ){
          this.getPopup().open({
            title: row[this.source.arch.username] + ' - ' + bbn._('Permissions'),
            height: '90%',
            width: 500,
            component: 'appui-usergroup-permissions',
            source: {
              perm_root: this.source.perm_root,
              id_user: row.id,
              sources: this.source.permissionsSources,
              rootAccess: this.source.permissionsAccess,
              rootOptions: this.source.permissionsOptions
            }
          });
        }
      },
      init(row){
        if (row.id && !!this.source.permissions.init) {
          this.confirm(bbn._("Are you sure you want to re-initialize this user's password?"), () => {
            this.post(appui.plugins['appui-usergroup'] + '/actions/users/init', {
              [this.source.arch['id']]: row[this.source.arch['id']]
            }, d => {
              if ( d.success ){
                appui.success(bbn._('An email has sent to the user.'));
              }
            });
          });
        }
      }
    },
    components: {
      editor: {
        template: '#appui-usergroup-user-edit-form',
        props: ['source'],
        data(){
          return {
            cp: this.closest('bbn-container').getComponent(),
            adminDisabled: !!this.source.row.admin
          }
        },
        computed: {
          isGroupReal(){
            return bbn.fn.isVue(this.cp)
              ? (bbn.fn.getField(this.cp.source.groups, 'type', {value: this.source.row[this.cp.source.arch.id_group]}) === 'real')
              : false;
          }
        },
        methods:{
          success(d, e){
            if ( d.success && d.data && d.data.id ){
              let idx = bbn.fn.search(this.cp.source.users, 'id', d.data.id);
              if ( idx > -1 ){
                this.cp.source.users[idx] = d.data;
              }
              else {
                this.cp.source.users.push(d.data);
              }
              this.cp.$refs.table.updateData();
              appui.success(bbn._('Saved'));
            }
            else {
              //this.$refs.form.source = this.$refs.form.originalData;
              e.preventDefault();
              appui.error(bbn._('Error!'));
            }
          }
        }
      },
      toolbar: {
        template: `
<div class="bbn-w-100 bbn-header bbn-spadded">
	<bbn-button :text="_('New user')"
              icon="nf nf-fa-user_plus"
              @click="insert"
              :disabled="isDisabled">
  </bbn-button>
	&nbsp;
	<!--<bbn-dropdown :source="groupTypes" v-if="cp && (cp.user.isAdmin || cp.user.isDev)"></bbn-dropdown>-->
</div>
`,
        data(){
          return {
            cp: null,
            groupTypes: [{
              text: bbn._('Web'),
              value: 'web'
            }, {
              text: bbn._('API'),
              value: 'api'
            }, {
              text: bbn._('Old'),
              value: 'old'
            }, {
              text: bbn._('Internal'),
              value: 'internal'
            }]
          }
        },
        computed: {
          isDisabled() {
            if (this.cp) {
              return !this.cp.source.permissions.insert
            }
            return true;
          }
        },
        methods: {
          insert() {
            this.cp.insert();
          }
        },
        mounted() {
          this.cp = this.closest('bbn-container').getComponent();
        },
      }
    }
  }
})();