(() => {
  return {
    props: ['source'],
    computed:{
      groupsSource(){
        return bbn.fn.map(this.source.groups, (v, i) => {
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
          text: bbn._('Edit'),
          notext: true,
          action: 'edit',
          icon: 'nf nf-fa-edit',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }, {
          text: bbn._('Delete'),
          notext: true,
          action: 'delete',
          icon: 'nf nf-fa-trash',
          disabled: !!(row.num || (this.source.is_dev && !this.source.is_admin))
        }, {
          text: bbn._('Permissions'),
          notext: true,
          action: this.permissions,
          icon: 'nf nf-fa-key',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }, {
          text: bbn._('Duplicate'),
          notext: true,
          action: this.duplicate,
          icon: 'nf nf-fa-copy',
          disabled: !!(this.source.is_dev && !this.source.is_admin)
        }];
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
        let newRow = bbn.fn.extend({}, row);
        newRow[this.source.arch.groups.id] = '';
        newRow.num = '';
        newRow.source_id = row[this.source.arch.groups.id];
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
              let tab = appui.getRef('router').activeContainer.getComponent(),
                  idx = bbn.fn.search(tab.source.groups, 'id', d.data.id);
              if ( idx > -1 ){
                tab.source.groups[idx] = d.data;
              }
              else {
                tab.source.groups.push(d.data);
              }
              tab.$refs.table.updateData();
              appui.success(bbn._('Save'));
            }
            else {
              let table = appui.getRef('router').activeContainer.getComponent().$refs.table;
              this.$refs.form.originalData = bbn.fn.extend({}, table.originalRow);
              bbn.fn.each(bbn.fn.extend({}, table.originalRow), (v, i) => {
                table.editedRow[i] = v;
              });
              e.preventDefault();
              appui.error(bbn._('Error!'));
            }
          }
        }
      }
    }
  }
})();