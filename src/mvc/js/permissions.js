var treeDS = new kendo.data.HierarchicalDataSource({
  filterable: true,
  data: data.tree,
  schema: {
    model: {
      id: "id",
      hasChildren: "is_parent",
      children: "items",
      fields: {
        text: {type: "string"},
        code: {type: "string"},
        is_parent: {type: "bool"}
      }
    }
  }
}),
$tree = $("div.bbn-tree:visible:first", ele).kendoTreeView({
  dataSource: treeDS,
  checkboxes: {
    template: function(e){
      return '<input type="checkbox" value="1"' +
        (e.item.checked ? ' checked="checked"' : '') +
        (e.item.disabled ? ' disabled="disabled"' : '') +
        '>';
    }
  },
  check: function(e){
    var dataItem = this.dataItem(e.node),
        checked = $(e.node).find(":checkbox:first").is(":checked"),
        url = data.root + "actions/permissions/" + (checked ? 'insert' : 'delete'),
        d = {id_option: dataItem.id};
    if ( data.id_user ){
      d.id_user = data.id_user;
    }
    else if ( data.id_group ){
      d.id_group = data.id_group;
    }
    appui.fn.post(url, d, function(r){
      if ( !r.success ){
        
      }
    });
  },
  select: function(e){
    e.preventDefault();
    return false;
  },
  template: function (e){
    return '<span class="' + e.item.icon + '"></span> ' + e.item.text + ' <span style="color: #CCC">' + e.item.code + '</span>';
  }
}).data("kendoTreeView");

setTimeout(function(){
  $tree.expand("li.k-item");
}, 500);
