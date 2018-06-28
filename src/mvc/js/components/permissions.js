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
              appui.success(bbn._('Sauvegardé!'));
            }
            else {
              appui.error(bbn._('Erreur!'));
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
              appui.success(bbn._('Sauvegardé!'));
            }
            else {
              appui.error(bbn._('Erreur!'));
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
              $.each(p.data.public, (i, v) => {
                if ( $.inArray(v, this.$refs.permsList.checked) === -1 ){
                  this.$refs.permsList.checked.push(v);
                }
                if ( $.inArray(v, this.$refs.permsList.disabled) === -1 ){
                  this.$refs.permsList.disabled.push(v);
                }
              });
              $.each(p.data.group, (i, v) => {
                if ( this.isUser ){
                  if ( $.inArray(v, this.$refs.permsList.disabled) === -1 ){
                    this.$refs.permsList.disabled.push(v);
                  }
                }
                if ( $.inArray(v, this.$refs.permsList.checked) === -1 ){
                  this.$refs.permsList.checked.push(v);
                }
              });
              if ( this.isUser ){
                $.each(p.data.user, (i, v) => {
                  if ( $.inArray(v, this.$refs.permsList.checked) === -1 ){
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