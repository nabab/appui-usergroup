(() => {
  return {
    props: ['source'],
    computed:{
      groupsSource(){
        return $.map(this.source.groups, (v, i) => {
          return {
            text: v[this.source.arch.group],
            value: v[this.source.arch.id]
          }
        });
      }
    },
    methods: {
      trClass(row){
        return 'valignm';
      },
      getButtons(row){
        return [{
          text: bbn._('Modifier'),
          notext: true,
          command: 'edit',
          icon: 'fa fa-edit',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }, {
          text: bbn._('Supprimer'),
          notext: true,
          command: this.remove,
          icon: 'fa fa-trash',
          disabled: !!(row.num || (this.source.is_dev && !this.source.is_admin))
        }, {
          text: bbn._('Permissions'),
          notext: true,
          command: this.permissions,
          icon: 'fa fa-key',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }, {
          text: bbn._('Dupliquer'),
          notext: true,
          command: this.duplicate,
          icon: 'fa fa-copy',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }];
      },
      save(row){
        if ( !row[this.source.arch.group] ){
          this.alert(bbn._("Nom est obligatoire!"));
        }
        else {
          bbn.fn.post(this.source.root + 'actions/groups/' + (row[this.source.arch.id] ? 'update' : 'insert'), row, (d) => {
            if ( d.success ){
              if ( !row[this.source.arch.id] ){
                this.source.groups.push(d.data);
              }
              else {
                let idx = bbn.fn.search(this.source.groups, this.source.arch.id, row[this.source.arch.id]);
                if ( idx > -1 ){
                  this.source.groups[idx] = row;
                }
              }
              //this.$refs.table._removeTmp();
              this.$refs.table.editedRow = false;
              this.$refs.table.editedIndex = false;
              this.$refs.table.updateData();
              appui.success(bbn._('Enregistré'));
            }
            else{
              appui.error(bbn._('Erreur!'));
            }
          });
        }
      },
      remove(row){
        if ( row[this.source.arch.id] && (!this.source.is_dev || this.source.is_admin) ){
          this.confirm(bbn._("Etes vous sur de vouloir supprimer cette entrée?"), () => {
            bbn.fn.post(this.source.root + "actions/groups/delete", {id: row[this.source.arch.id]}, (d) => {
              if ( d.success ){
                let idx = bbn.fn.search(this.source.groups, this.source.arch.id, row[this.source.arch.id]);
                if ( idx > -1 ){
                  this.source.groups.splice(idx, 1);
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
              root: this.source.root,
              perm_root: this.source.perm_root,
              opt_url: this.source.opt_url,
              id_group: row.id
            }
          });
        }
      },
      duplicate(row){
        let newRow = $.extend({}, row);
        newRow.id = '';
        newRow.num = '';
        newRow.source_id = row.id;
        this.$refs.table.insert(newRow);
      }
    },
    compopnents: {
      'appui-usergroup-group-edit-form': {
        template: '#appui-usergroup-group-edit-form',
        props: ['source'],
        methods:{
          success(d, e){
            if ( d.success && d.data && d.data.id ){
              let tab = appui.$refs.tabnav.activeTab.getComponent(),
                  idx = bbn.fn.search(tab.source.groups, 'id', d.data.id);
              if ( idx > -1 ){
                tab.source.groups[idx] = d.data;
              }
              else {
                tab.source.groups.push(d.data);
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
              appui.error(bbn._('Erreur!'));
            }
          }
        }
      }
    }
  }
})();
