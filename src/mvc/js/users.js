(() => {
  return {
    props: ['source'],
    computed: {
      root(){
        return appui.plugins['appui-usergroup']+'/';
      },
      user(){
        return appui.app.user;
      },
      themes(){
        return appui.themes;
      }
    },
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
          disabled: !!(((row[this.source.arch.admin] || row[this.source.arch.dev]) && !this.user.isAdmin) || (this.user.isDev && !this.user.isAdmin))
        }, {
          text: bbn._('Supprimer'),
          notext: true,
          command: this.remove,
          icon: 'fa fa-trash',
          disabled: !!(row[this.source.arch.admin] || (row[this.source.arch.dev] && !this.user.isAdmin) || (this.user.isDev && !this.user.isAdmin))
        }, {
          text: bbn._('Permissions'),
          notext: true,
          command: this.permissions,
          icon: 'fa fa-key',
          disabled: !!((this.user.isDev && !this.user.isAdmin) || row[this.source.arch.admin])
        }];
      },
      insert(){
        if ( !this.user.isDev || this.user.isAdmin ){
          this.$refs.table.insert({}, {
            title: bbn._("Création d'un user"),
            width: 450,
            height: 400
          });
        }
      },
      edit(row){
        if ( (!this.user.isDev || this.user.isAdmin) && (!row[this.source.arch.dev] || this.user.isAdmin) ){
          this.$refs.table.edit(row, {
            title: bbn._("Modification d'un user"),
            width: 450,
            height: 400
          });
        }
      },
      remove(row){
        if ( row[this.source.arch.id] &&
          !row[this.source.arch.admin] &&
          (!this.user.isDev || this.user.isAdmin) &&
          (!row[this.source.arch.dev] || this.user.isAdmin)
        ){
          this.confirm(bbn._("Etes vous sur de vouloir supprimer cette entrée?"), () => {
            bbn.fn.post(this.root + "actions/users/delete", {id: row[this.source.arch.id]}, (d) => {
              if ( d.success ){
                let idx = bbn.fn.search(this.source.users, 'id', row[this.source.arch.id]);
                if ( idx > -1 ){
                  this.source.users.splice(idx, 1);
                  this.$refs.table.updateData();
                  appui.success(bbn._('Supprimé'));
                }
              }
              else {
                appui.error(bbn._('Erreur!'));
              }
            });
          });
        }
      },
      permissions(row){
        if ( this.source.perm_root && row.id ){
          this.getPopup().open({
            title: bbn._('Permissions'),
            height: '90%',
            width: 500,
            component: 'appui-usergroup-permissions',
            source: {
              perm_root: this.source.perm_root,
              id_user: row.id
            }
          });
        }
      }
    },
    components: {
      'appui-usergroup-user-edit-form': {
        template: '#appui-usergroup-user-edit-form',
        props: ['source'],
        data(){
          return {
            cp: bbn.vue.closest(this, 'bbns-tab').getComponent(),
            adminDisabled: !!this.source.row.admin
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
              appui.success(bbn._('Enregistré'));
            }
            else {
              this.$refs.form.source = this.$refs.form.originalData;
              e.preventDefault();
              appui.error(bbn._('Erreur!'));
            }
          }
        }
      }
    }
  }
})();