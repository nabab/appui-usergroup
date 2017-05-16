/**
 * Created by BBN on 26/10/2016.
 */
var ele = $(".bbn-usergroups-grid", ele),
    duplicateItem = false;
ele.kendoGrid({
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
        var grid = ele.data("kendoGrid");
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
        var grid = ele.data("kendoGrid");
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
        var grid = ele.data("kendoGrid");
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
  },
});
