(() => {
  return {
    props: ['source'],
    methods: {
      trClass(row){
        return 'valignm' + (row[this.source.arch.admin] ? ' w3-black' : '');
      },
      renderTel(row){
        return row[this.source.arch.tel] || '-';
      },
      renderFonction(row){
        return row[this.source.arch.fonction] || '-';
      },
      getButtons(row){
        return [{
          text: bbn._('Modifier'),
          notext: true,
          command: this.edit,
          icon: 'fa fa-edit',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }, {
          text: bbn._('Supprimer'),
          notext: true,
          command: this.remove,
          icon: 'fa fa-trash',
          disabled: !!(row[this.source.arch.admin] || (row[this.source.arch.dev] && !this.source.is_admin) || (this.source.is_dev && !this.source.is_admin))
        }, {
          text: bbn._('Permissions'),
          notext: true,
          command: this.permissions,
          icon: 'fa fa-key',
          disabled: !this.source.is_admin
        }];
      },
      insert(){
        if ( !this.source.is_dev || this.source.is_admin ){
          this.$refs.table.insert({}, {
            title: bbn._("Création d'un user"),
            width:'350px',
            height:'350px'
          });
        }
      },
      edit(row){
        if ( (!this.source.is_dev || this.source.is_admin) && (!row[this.source.arch.dev] || this.source.is_admin) ){
          this.$refs.table.edit(row, {
            title: bbn._("Modification d'un user"),
            width:'350px',
            height:'350px'
          });
        }
      },
      remove(row){
        if ( row[this.source.arch.id] &&
          !row[this.source.arch.admin] &&
          (!this.source.is_dev || this.source.is_admin) &&
          (!row[this.source.arch.dev] || this.source.is_admin)
        ){
          this.$refs.table.getPopup().confirm(bbn._("Etes vous sur de vouloir supprimer cette entrée?"), () => {
            bbn.fn.post(this.source.root + "actions/users/delete", {id: row[this.source.arch.id]}, (d) => {
              if ( d.success ){
                let idx = bbn.fn.search(this.source.users, 'id', row[this.source.arch.id]);
                if ( idx > -1 ){
                  this.source.users.splice(idx, 1);
                  this.$refs.table.updateData();
                  appui.success(bbn._('Supprimé'));
                }
              }
              else {
                appui.error(bbn._('Erreur'));
              }
            });
          });
        }
      },
      permissions(row){
        if ( this.source.perm_root && row.id ){
          this.popup().open({
            title: bbn._('Permissions'),
            height: '90%',
            width: 500,
            component: 'appui-usergroup-permissions',
            source: {
              root: this.source.root,
              perm_root: this.source.perm_root,
              opt_url: this.source.opt_url,
              id_user: row.id
            }
          });
        }
      }
    },
    beforeMount(){
      bbn.vue.setComponentRule(this.source.root + 'components/', 'appui-usergroup');
      bbn.vue.addComponent('permissions');
      bbn.vue.unsetComponentRule();
    },
    components: {
      'appui-usergroup-user-edit-form': {
        template: '#appui-usergroup-user-edit-form',
        props: ['source'],
        data(){
          return {
            themes: appui.themes,
            adminDisabled: !!this.source.row.admin
          }
        },
        methods:{
          success(d, e){
            if ( d.success && d.data && d.data.id ){
              let tab = appui.$refs.tabnav.activeTab.getComponent(),
                  idx = bbn.fn.search(tab.source.users, 'id', d.data.id);
              if ( idx > -1 ){
                tab.source.users[idx] = d.data;
              }
              else {
                tab.source.users.push(d.data);
              }
              tab.$refs.table.updateData();
              appui.success(bbn._('Enregistré'));
            }
            else {
              let table = appui.$refs.tabnav.activeTab.getComponent().$refs.table;
              this.$refs.form.originalData = $.extend({}, table.originalRow);
              $.each($.extend({}, table.originalRow), (i, v) => {
                table.editedRow[i] = v;
              });
              e.preventDefault();
              appui.error(bbn._('Erreur'));
            }
          }
        }
      }
    }
  }
})();