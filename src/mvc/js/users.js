(function(){
  return function(ele, data){
    if ( data.arch.id && data.arch.email ){
      var $cont = $(".bbn-users-grid", ele),
          num_session = 0,
          primary_columns = [
            {
              field: data.arch.id,
              title: data.lng.id,
              width: 50,
              filterable: false,
              hidden: data.is_admin ? true : false
            },{
              field: data.arch.email,
              title: data.lng.email,
              template: function(e){
                if ( e[data.arch.email] ){
                  return '<a href="mailto: ' + e[data.arch.email] + '">' + e[data.arch.email] + '</a>';
                }
                return '-';
              }
            }
          ],
          secondary_columns = [{
            field: "id_group",
            title: data.lng.group,
            values: data.is_admin ? data.groups : data.groups.slice(1),
            template: function(e){
              return bbn.fn.get_field(data.groups, "value", e.id_group, "text");
            }
          },{
            field: "last_activity",
            title: data.lng.last_seen,
            width: 100,
            template: function(d){
              return bbn.fn.fdate(d.last_activity, '<em>Jamais</em>');
            }
          }],
          action_columns = [{
            title: data.lng.actions,
            width: 160,
            field: "id",
            filterable: false,
            sortable: false,
            template: function (d){
              var st = '';
              if (
                (data.is_admin || (d.id_group !== 1)) &&
                (d.id !== bbn.env.userId)
              ){
                st += '<a class="k-button k-button-icontext k-grid-edit" href="javascript:;" title="' + data.lng.edit + '"><i class="fa fa-edit"> </i></a>' +
                  '<a class="k-button k-button-icontext k-grid-delete" href="javascript:;" title="' + data.lng.deactivate + '"><i class="fa fa-trash"> </i></a>' +
                  '<a class="k-button k-button-icontext bbn-user-reset" href="javascript:;" title="' + data.lng.reset_password + '"><i class="fa fa-envelope"> </i></a>' +
                  '<a class="k-button k-button-icontext bbn-user-permissions" href="javascript:;" title="' + data.lng.manage_user_permissions + '"><i class="fa fa-key"> </i></a>';
              }
              return st;
            }
          }];
      if ( data.arch.username ){
        primary_columns.push({
          field: data.arch.username,
          title: data.lng.name
        });
      }
      if ( data.arch.login ){
        primary_columns.push({
          title: data.lng.login,
          field: data.arch.login,
        });
      }
      for ( var n in data.arch ){
        if (
          (n !== 'id') &&
          (n !== 'email') &&
          (n !== 'username') &&
          (n !== 'login') &&
          (n !== 'cfg') &&
          (n !== 'id_group') &&
          (n !== 'active') &&
          (n !== 'last_activity')
        ){
          primary_columns.push({
            title: n,
            field: n
          });
        }
      }

      $cont.kendoGrid({
        columnMenu: true,
        pageable: true,
        columns: primary_columns.concat(secondary_columns).concat(action_columns),
        toolbar: [
          {name: "create", text: data.lng.new_user},
          {name: "pdf", text: data.lng.generate_pdf}
        ],
        pdf: {
          fileName: "Utilisateurs.pdf"
        },
        dataBound: function(e){
          // Initialize button
          $(".bbn-user-reset", e.sender.element).click(function(ev){
            bbn.fn.confirm("Êtes-vous sûr de vouloir réïnitialiser le mot de passe de cet utilisateur?", function(){
              var dataItem = e.sender.dataItem($(ev.target).closest("tr"));
              bbn.fn.post(data.root + "actions/users/init", {id: dataItem.id}, function(d){
                if ( d.success ){
                  bbn.fn.alert(data.lng.email_sent_to + " " + dataItem.email, "Succès");
                }
                else{
                  bbn.fn.alert(data.lng.impossible_to_reset);
                }
              });
            })
          });
          $(".bbn-user-permissions", e.sender.element).click(function(ev){
            var tr = $(ev.target).closest("tr"),
                id_user = e.sender.dataItem(tr).toJSON().id;
            bbn.fn.window(data.root + 'permissions', "90%", "90%", {id_user: id_user});
          });
          e.sender.element.find("tbody > tr").each(function(){
            if ( !e.sender.dataItem(this).get("num_sessions") ){
              $(this).find("td.k-hierarchy-cell a:first").hide();
            }
          });
        },
        dataSource: {
          pageSize: 30,
          sort: {
            field: "last_activity",
            dir: "desc"
          },
          schema: {
            data: "data",
            total: "total",
            model: {
              id: "id",
              fields: {
                id: {type: "number", editable: false},
                nom: {type: "string", validation: {required: true}},
                email: {type: "string", validation: {required: true}},
                id_group: {type: "number", defaultValue: 2, validation: {required: true}},
                last_activity: {type: "date", editable: false, defaultValue: null},
              }
            }
          },
          transport:{
            read: function(o){
              return o.success({data: data.users, total: data.users.length});
            },
            create: function(o){
              var grid = $cont.data("kendoGrid");
              bbn.fn.post(data.root + "actions/users/insert", o.data, function(d){
                if ( d.success ){
                  // Cas où l'option fait partie des options chargées dans l'application
                  o.success(d);
                }
                else{
                  o.error();
                }
              });
            },
            update: function(o){
              var grid = $cont.data("kendoGrid");
              if ( typeof(o.data.id) !== 'undefined' ){
                bbn.fn.post(data.root + "actions/users/update", o.data, function(d){
                  // Un enregistrement doit être renvoyé dans le tableau d.data
                  if ( d.success ){
                    o.success(d);
                  }
                  else{
                    o.error();
                  }
                });
              }
            },
            destroy: function(o) {
              var grid = $cont.data("kendoGrid");
              if ( typeof(o.data.id) !== 'undefined' ){
                bbn.fn.confirm(
                  "Etes vous sur de vouloir supprimer cette entrée?",
                  function(){
                    bbn.fn.post(data.root + "actions/users/delete", {id: o.data.id}, function(d){
                      if ( d.success ){
                        o.success();
                      }
                      else{
                        grid.cancelChanges();
                      }
                    });
                  },
                  function(){
                    grid.cancelChanges();
                  }
                );
              }
              else{
                grid.cancelChanges();
              }
            }
          }
        },
        editable: {
          mode:"popup",
          confirmation: false,
          window: {
            width: 720
          }
        },
        /*filterable: {
          cell: {
            showOperators: false
          }
        },*/
        scrollable: true,
        resizable: true,
        sortable: true,
        filterable: {
          mode: "row"
        },
        edit: function(e){
          num_session = e.model.num;
          bbn.fn.hideUneditable(e);
          e.container
            .parent()
            .find(".k-window-title:first")
            .html(e.model.id ? "Modification de l'utilisateur" : "Nouvel utilisateur");
        },
        detailInit: function(e){
          bbn.fn.log(e);
        }
      });
    }
  };
})();
