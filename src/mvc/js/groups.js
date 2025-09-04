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
        const table = this;
        return [{
          label: bbn._('Edit'),
          notext: true,
          action: 'edit',
          icon: 'nf nf-fa-edit',
          disabled: !this.source.permissions.update
        }, {
          label: bbn._('Delete'),
          notext: true,
          action: 'delete',
          icon: 'nf nf-fa-trash',
          disabled: !!(row.num || !this.source.permissions.delete)
        }, {
          label: bbn._('Permissions'),
          notext: true,
          action: row => table.openPermissions(row),
          icon: 'nf nf-fa-key',
          disabled: !this.source.permissions.permissions
        }, {
          label: bbn._('Duplicate'),
          notext: true,
          action: row => table.duplicate(row),
          icon: 'nf nf-fa-copy',
          disabled: !this.source.permissions.insert
        }];
      },
      openPermissions(row){
        if ( this.source.perm_root && row.id ){
          this.getPopup({
            label: row[this.source.arch.groups.group] + ' - ' + bbn._('Permissions'),
            height: '90%',
            width: 500,
            component: 'appui-usergroup-permissions',
            source: {
              perm_root: this.source.perm_root,
              id_group: row.id,
              sources: this.source.permissionsSources,
              rootAccess: this.source.permissionsAccess,
              rootOptions: this.source.permissionsOptions
            }
          });
        }
      },
      duplicate(row){
        if (!!this.source.permissions.insert) {
          let newRow = bbn.fn.extend({}, row);
          newRow[this.source.arch.groups.id] = '';
          newRow.num = '';
          newRow.source_id = row[this.source.arch.groups.id];
          this.$refs.table.insert(newRow);
        }
      }
    },
    mounted(){
      appui.register('appui-usergroup-groups', this);
    },
    components: {
      form: {
        template: `
          <bbn-form bbn-if="groups"
                    :action="root + 'actions/groups'"
                    :source="source.row"
                    :data="formData"
                    @success="afterSubmit">
            <div class="bbn-grid-fields bbn-padding">
              <label>` + bbn._('Name') + `</label>
              <bbn-input bbn-model="source.row[groups.source.arch.groups.group]"/>
              <label>` + bbn._('Code') + `</label>
              <bbn-input bbn-model="source.row[groups.source.arch.groups.code]"/>
              <label bbn-if="groups.hasDashboard">` + bbn._('Default dashboard') + `</label>
              <bbn-dropdown bbn-if="groups.hasDashboard"
                            bbn-model="source.row.default_dashboard"
                            :source="groups.source.dashboards"/>
              <label bbn-if="groups.hasMenu">` + bbn._('Default menu') + `</label>
              <bbn-dropdown bbn-if="groups.hasMenu"
                            bbn-model="source.row.default_menu"
                            :source="groups.source.menus"/>
            </div>
          </bbn-form>`,
        mixins: [bbn.cp.mixins.basic],
        props: {
          source: {
            type: Object
          }
        },
        data(){
          return {
            root: appui.plugins['appui-usergroup'] + '/',
            groups: appui.getRegistered('appui-usergroup-groups'),
            formData: bbn.fn.extend({action: this.source.row.id ? 'update' : 'insert'}, this.source.data)
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
        }
      }
    }
  }
})();