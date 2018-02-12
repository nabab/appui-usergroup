/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 12/02/2018
 * Time: 10:56
 */
(() => {
  return {
    computed: {
      id_type(){
        return 'id_' + this.source.type;
      }
    },
    methods: {
      treeMapper(n){
        n.text += '<span class="appui-usergroup-permissions-list-code">' + n.code + '</span>';
        return n;
      },
      permissionSelect(n){
        bbn.fn.post(this.source.opt_url + '/permissions', {
          id: n.data.id,
          full: 1
        }, (d) => {
          this.selected = d.data || false;
        });
      },
      setPerm(idPerm){
        if ( idPerm && this.source.id ){
          bbn.fn.post(this.source.opt_url + 'permissions/add', {
            [this.id_type]: this.source.id,
            id_option: idPerm
          }, (d) => {
            if ( d.data.res ){
              appui.success(bbn._('Saved!'));
            }
            else {
              appui.error(bbn._('Error!'));
            }
          });
        }
      },
      unsetPerm(idPerm){
        if ( idPerm && this.source.id ){
          bbn.fn.post(this.source.opt_url + 'permissions/remove', {
            [this.id_type]: this.source.id,
            id_option: idPerm
          }, (d) => {
            if ( d.data.res ){
              appui.success(bbn._('Saved!'));
            }
            else {
              appui.error(bbn._('Error!'));
            }
          });
        }
      }
    }
  };
})();