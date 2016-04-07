// Javascript Document
var $tree,
    treeDS = new kendo.data.HierarchicalDataSource({
      data: data.groups,
      schema: {
        model: {
          id: "id",
          hasChildren: "is_parent",
          children: "items",
          fields: {
            text: {type: "string"},
            is_parent: {type: "bool"}
          }
        }
      }
    });


$tree = $("div.bbn_usergroup_tree", ele).kendoTreeView({
  dataSource: treeDS,
  select: function (e) {
    if ( data.picker ){
      var r = this.dataItem(e.node);
      $(data.picker).val(r.id);
      appui.fn.closeAlert();
    }
  },
  template: function (e) {
    return '<i class="fa fa-' + (e.item.is_parent ? 'users' : 'user') + '"> </i> ' + e.item.text;
  }
}).data("kendoTreeView");

$li = $("li.k-item li.k-item", $tree.element);
$("input:first", ele).keyup(function(){
  var v = $(this).val().toLowerCase();
  $li.filter(":hidden").show();
  if ( v.length ){
    appui.fn.log($li.length, v);
    $li.filter(function(){
      var txt = appui.fn.removeAccents($(this).find("span:not(.k-icon):first").text().toLowerCase());
      appui.fn.log(txt.indexOf(v), txt, v)
      return txt.indexOf(v) === -1;
    }).hide();
  }
  /*
  var data = treeDS.data();
  data.forEach(function(a){
    appui.fn.log(a, this);
    a.filter({field: "text", operator: "contains", value: $(this).val()});
  })
  appui.fn.log(treeDS, treeDS.data());
  treeDS.filter({field: "text", operator: "contains", value: $(this).val()});
  Porca putana!
  */
});
