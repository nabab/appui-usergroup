/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 15/06/2018
 * Time: 12:44
 */
(() => {
  return {
    props: {
      source: {
        type: Array,
        default(){
          let def = [];
          if ( appui.app.groups && appui.app.users ){
            appui.app.groups.forEach(group => {
              let users = appui.app.users.filter(u => {
                return u.id_group === group.id;
              });
              users = users.map(u => {
                let us = Object.assign({icon: 'fas fa-user'}, u);
                us.id = us.value;
                delete us.value;
                return us;
              });
              def.push({
                id: group.id,
                text: group.nom,
                items: bbn.fn.order(users, 'text'),
                num: users.length,
                icon: 'fas fa-users'
              });
            });
          }
          return bbn.fn.order(def, 'text');
        }
      },
      multi: {
        type: Boolean,
        default: false
      }
    },
    data(){
      return {
        sel: []
      }
    },
    computed: {
      selected(){
        return this.sel.length === 1 ? this.sel[0] : this.sel;
      }
    },
    methods: {
      add(id, check){
        if ( this.sel.indexOf(id) === -1 ){
          this.sel.push(id);
        }
        if ( check && (this.$refs.tree.checked.indexOf(id) === -1) ){
          this.$refs.tree.checked.push(id);
        }
      },
      del(id, check){
        let idx = this.sel.indexOf(id),
            idx2 = this.$refs.tree.checked.indexOf(id);
        if ( idx > -1 ){
          this.sel.splice(idx, 1);
        }
        if ( check && (idx2 > -1) ){
          this.$refs.tree.checked.splice(idx2, 1);
        }
      },
      checkItem(item){
        let idx = bbn.fn.search(this.source, 'id', item);
        if ( (idx > -1) && this.source[idx].items ){
          this.source[idx].items.forEach(u => {
            this.add(u.id, true);
          });
        }
        else {
          this.add(item);
        }
      },
      uncheckItem(item){
        let idx = bbn.fn.search(this.source, 'id', item);
        if ( (idx > -1) && this.source[idx].items ){
          this.source[idx].items.forEach(u => {
            this.del(u.id, true);
          });
        }
        else {
          this.del(item);
        }
      },
      selectItem(item){
        if ( !this.multi && !item.items.length && item.data.id ){
          this.$set(this, 'sel', []);
          this.add(item.data.id);
        }
      }
    },
    watch: {
      selected(newVal){
        this.$emit('input', newVal);
      }
    }
  }
})();