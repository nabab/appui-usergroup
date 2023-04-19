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
        opt_root: appui.plugins['appui-option'],
        disabled: [],
        mode: this.source.mode || 'access',
        modes: [
          {
            text: bbn._("Access"),
            value: 'access'
          }, {
            text: bbn._("Options"),
            value: 'options'
          }
        ],
        currentSource: this.source.rootAccess
      }
    },
    computed: {
      idType(){
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
        if (!n.text && n.alias) {
          n.text = n.alias.text + ' <span class="appui-usergroup-permissions-list-code bbn-blue">' + n.alias.code + '</span>';
        }
        n.text += '<span class="appui-usergroup-permissions-list-code">' + n.code + '</span>';
        return n;
      },
      setPerm(idPerm){
        if (idPerm && this.source[this.idType]) {
          this.post(this.opt_root + '/permissions/actions/add', {
            [this.idType]: this.source[this.idType],
            id_option: idPerm
          }, d => {
            if (d.success) {
              appui.success(bbn._('Saved!'));
            }
            else {
              appui.error(bbn._('Error!'));
            }
          });
        }
      },
      unsetPerm(idPerm){
        if (idPerm && this.source[this.idType]) {
          this.post(this.opt_root + '/permissions/actions/remove', {
            [this.idType]: this.source[this.idType],
            id_option: idPerm
          }, d => {
            if (d.success) {
              appui.success(bbn._('Saved!'));
            }
            else {
              appui.error(bbn._('Error!'));
            }
          });
        }
      },
      getPerms(d){
        if (d.id && this.idType && this.source[this.idType]) {
          this.post(this.root + '/actions/permissions/get', {
            id: d.id,
            [this.idType]: this.source[this.idType]
          }, p => {
            let permsList = this.getRef('permsList');
            if (p.data && permsList) {
              bbn.fn.each(p.data.public, v => {
                if (!permsList.checked.includes(v)) {
                  permsList.checked.push(v);
                }
                if (!permsList.disabled.includes(v)) {
                  permsList.disabled.push(v);
                }
              });
              bbn.fn.each(p.data.group, v => {
                if (this.isUser) {
                  if (!permsList.disabled.includes(v)) {
                    permsList.disabled.push(v);
                  }
                }
                if (!permsList.checked.includes(v)) {
                  permsList.checked.push(v);
                }
              });
              if (this.isUser) {
                bbn.fn.each(p.data.user, (v, i) => {
                  if (!permsList.checked.includes(v)) {
                    permsList.checked.push(v);
                  }
                });
              }
            }
          });
        }
      }
    },
    watch: {
      currentSource(){
        this.$nextTick(() => {
          this.getRef('permsList').updateData();
        });
      },
      mode(v) {
        let isOptions = v === 'options';
        let src = bbn.fn.getRow(this.source.sources, isOptions ? 'rootAccess' : 'rootOptions', this.currentSource);
        this.currentSource = src[isOptions ? 'rootOptions' : 'rootAccess'] || (isOptions ? this.source.rootOptions : this.source.rootAccess);
      }
    }
  };
})();