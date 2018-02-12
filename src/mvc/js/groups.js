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
          this.popup().alert(bbn._("Nom is mandatory!"));
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
              this.$refs.table._removeTmp();
              this.$refs.table.editedRow = false;
              this.$refs.table.updateData();
              appui.success(bbn._('Enregistré'));
            }
            else{
              appui.error(bbn._('Erreur'));
            }
          });
        }
      },
      remove(row){
        if ( row[this.source.arch.id] && (!this.source.is_dev || this.source.is_admin) ){
          this.$refs.table.getPopup().confirm(bbn._("Etes vous sur de vouloir supprimer cette entrée?"), () => {
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
                appui.error(bbn._('Erreur'));
              }
            });
          });
        }
      },
      permissions(row){
        
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
              appui.error(bbn._('Erreur'));
            }
          }
        }
      }
    }
  }
})();



/*
(function(){
  return function(ele, data){
    var $grid = $(".bbn-usergroups-grid", ele),
        duplicateItem = false;
    $grid.kendoGrid({
      columns: [
        {
          field: data.arch.id,
          hidden: true
        }, {
          field: "source_id",
          hidden: true
        }, {
          title: "Nom",
          field: data.arch.group,
          editor: function(container, o){
            container.append('<input class="k-input k-textbox k-valid large" name="' + data.arch.group + '" required="required" data-bind="value:' + data.arch.group + '" type="text">');
          }
        }, {
          title: "#",
          field: "num",
          width: 50
        },{
          title: data.lng.actions,
          width: 160,
          field: "id",
          filterable: false,
          sortable: false,
          template: function(d){
            var st = '<a class="k-button k-button-icontext k-grid-edit" href="javascript:;" title="' + data.lng.edit + '"><i class="fa fa-edit"> </i></a>' +
              '<a class="k-button k-button-icontext bbn-group-permissions" href="javascript:;" title="' + data.lng.manage_user_permissions+ '"><i class="fa fa-key"> </i></a>' +
              '<a class="k-button k-button-icontext bbn-group-copy" href="javascript:;" title="' + data.lng.duplicate+ '"><i class="fa fa-copy"> </i></a>';
            if ( !d.num ){
              st += '<a class="k-button k-button-icontext k-grid-delete" href="javascript:;" title="' + data.lng.deactivate + '"><i class="fa fa-trash"> </i></a>';
            }
            return st;
          },
        }
      ],
      toolbar: [{
        name: "create",
        text: "Nouveau groupe"
      }],
      dataSource: {
        sort: {
          field: "group",
          dir: "asc"
        },
        schema: {
          data: "data",
          total: "total",
          model: {
            id: data.arch.id,
            fields: [{
              field: data.arch.id,
              type: "number",
              editable: false
            }, {
              field: "source_id",
              type: "string",
              editable: false
            }, {
              field: data.arch.group,
              type: "string",
              validation: {
                required: true
              }
            }, {
              field: "num",
              type: "number",
              editable: false,
              validation: {
                required: true
              }
            }, {
              field: data.arch.cfg,
              type: "hidden",
              editable: false,
              defaultValue: "{}",
              validation: {
                required: "1"
              }
            }]
          }
        },
        transport:{
          read: function(o){
            o.success({data: data.groups, total: data.groups.length});
          },
          create: function(o){
            var grid = $grid.data("kendoGrid");
            if ( duplicateItem ){
              o.data.source_id = duplicateItem.source_id;
            }
            bbn.fn.post(data.root + "actions/groups/insert", o.data, function(d){
              if ( d && d.success ){
                o.success(d);
              }
              else{
                o.error();
                grid.cancelChanges();
              }
            });
          },
          update: function(o){
            var grid = $grid.data("kendoGrid");
            duplicateItem = false;
            if ( typeof(o.data[data.arch.id]) !== 'undefined' ){
              bbn.fn.post(data.root + "actions/groups/update", o.data, function(d){
                // Un enregistrement doit être renvoyé dans le tableau d.data
                if ( d && d.success ){
                  o.success(d);
                }
                else{
                  o.error();
                  grid.cancelChanges();
                }
              });
            }
          },
          destroy: function(o) {
            var grid = $grid.data("kendoGrid");
            if ( typeof(o.data[data.arch.id]) !== 'undefined' ){
              bbn.fn.confirm(data.lng.sure_to_delete_group, function(){
                var dt = {};
                dt[data.arch.id] = o.data.id;
                bbn.fn.post(data.root + "actions/groups/delete", dt, function(d){
                  if ( d && d.success ){
                    o.success();
                  }
                  else{
                    o.error();
                    grid.cancelChanges();
                  }
                });
              }, function(){
                grid.cancelChanges();
              })
            }
            else{
              grid.cancelChanges();
            }
          }
        },
      },
      editable: {
        mode: "popup",
        confirmation: false,
        window: {
          height: 150,
          width: 750
        }
      },
      dataBound: function(e){
        // Initialize button
        $(".bbn-group-copy", e.sender.element).click(function(ev){
          var src = e.sender.dataItem($(ev.target).closest("tr"));
          duplicateItem = {
            source_id: src[data.arch.id]
          };
          duplicateItem[data.arch.group] = src[data.arch.group];
          e.sender.addRow();
          var dest = e.sender.dataItem(e.sender.element.find("tbody tr:first"));
          bbn.fn.log(src, dest);
        });
        $(".bbn-group-permissions", e.sender.element).click(function(ev){
          var tr = $(ev.target).closest("tr"),
              id_group = e.sender.dataItem(tr).toJSON()[data.arch.id];
          bbn.fn.window(data.root + 'permissions', "90%", "90%", {id_group: id_group}, function(){

          });
        });
      },
      sortable: true,
      scrollable: true,
      cancel: function(){
        duplicateItem = false;
      },
      edit: function(e){
        bbn.fn.hideUneditable(e);
        if ( duplicateItem ){
          e.container
            .parent()
            .find(".k-window-title:first")
            .html(data.lng.create_a_new_group_based_on + " " + duplicateItem[data.arch.group]);
        }
        else{
          e.container
            .parent()
            .find(".k-window-title:first")
            .html(e.model.id ? data.lng.edit_group : data.lng.new_group);
        }
      }
    });
  }
})();*/
