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
      },
      hasDashboard(){
        return !!appui.plugins['appui-dashboard'];
      },
      hasMenu(){
        return !!appui.plugins['appui-menu'];
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
    mounted(){
      appui.register('appui-usergroup-groups', this);
    },
    components: {
      form: {
        template: `
          <bbn-form :action="root + 'actions/groups'"
                    :source="source.row"
                    :data="extend({action: !!source.row.id ? 'update' : 'insert'}, source.data)"
                    v-if="groups"
                    @success="afterSubmit"
          >
            <div class="bbn-grid-fields bbn-padded">
              <label>` + bbn._('Name') + `</label>
              <bbn-input v-model="source.row[groups.source.arch.groups.group]"/>
              <label>` + bbn._('Code') + `</label>
              <bbn-input v-model="source.row[groups.source.arch.groups.code]"/>
              <label v-if="groups.hasDashboard">` + bbn._('Default dashboard') + `</label>
              <bbn-dropdown v-if="groups.hasDashboard"
                            v-model="source.row.default_dashboard"
                            :source="groups.source.dashboards"/>
              <label v-if="groups.hasMenu">` + bbn._('Default menu') + `</label>
              <bbn-dropdown v-if="groups.hasMenu"
                            v-model="source.row.default_menu"
                            :source="groups.source.menus"/>
            </div> 
          </bbn-form>`,
        props: {
          source: {
            type: Object
          }
        },
        data(){
          return {
            root: appui.plugins['appui-usergroup'] + '/',
            groups: false
          }
        },
        methods: {
          extend: bbn.fn.extend,
          afterSubmit(d){
            if (d.success) {
              this.closest('bbn-container').reload();
            }
            else {
              appui.error();
            }
          }
        },
        mounted(){
          this.groups = appui.getRegistered('appui-usergroup-groups');
        }
      },
      'appui-usergroup-group-edit-form': {
        template: '#appui-usergroup-group-edit-form',
        props: ['source'],
        methods:{
          success(d, e){
            if ( d.success && d.data && d.data.id ){
              let tab = this.closest('bbn-component').getComponent(),
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
              let table = this.closest('bbn-component').getComponent().$refs.table;
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