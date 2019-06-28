/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 12/02/2018
 * Time: 10:56
 */
(() => {
  return {
    data(){
      return {
        root: appui.plugins['appui-usergroup'],
        opt_root: appui.plugins['appui-options'],
        disabled: []
      }
    },
    computed: {
      id_type(){
        return 'id_' + (this.source.id_user !== undefined ? 'user' : 'group');
      },
      isUser(){
        return !!this.source.id_user;
      },
      isGroup(){
        return !!this.source.id_group;
      }
    },
    methods: {
      treeMapper(n){
        n.text += '<span class="appui-usergroup-permissions-list-code">' + n.code + '</span>';
        return n;
      },
      setPerm(idPerm){
        if ( idPerm && this.source[this.id_type] ){
          bbn.fn.post(this.opt_root + '/permissions/add', {
            [this.id_type]: this.source[this.id_type],
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
        if ( idPerm && this.source[this.id_type] ){
          bbn.fn.post(this.opt_root + '/permissions/remove', {
            [this.id_type]: this.source[this.id_type],
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
      getPerms(d){
        if ( d.id && this.id_type && this.source[this.id_type] ){
          bbn.fn.post(this.root + '/actions/permissions/get', {
            id: d.id,
            [this.id_type]: this.source[this.id_type]
          }, (p) => {
            if ( p.data ){
              bbn.fn.each(p.data.public, (v, i) => {                
                if ( !this.$refs.permsList.checked.includes(v) ){  
                  this.$refs.permsList.checked.push(v);
                }                
                if ( !this.$refs.permsList.disabled.includes(v) ){  
                  this.$refs.permsList.disabled.push(v);
                }
              });
              bbn.fn.each(p.data.group, (v, i) => {
                if ( this.isUser ){
                  if ( !this.$refs.permsList.disabled.includes(v) ){
                    this.$refs.permsList.disabled.push(v);
                  }
                }
                if ( !this.$refs.permsList.checked.includes(v) ){
                  this.$refs.permsList.checked.push(v);
                }
              });
              if ( this.isUser ){
                bbn.fn.each(p.data.user, (v, i) => {
                  if ( !this.$refs.permsList.checked.includes(v) ){
                    this.$refs.permsList.checked.push(v);
                  }
                });
              }
            }
          });
        }
      }
    }
  };
})();