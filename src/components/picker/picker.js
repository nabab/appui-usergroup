/**
 * Created by BBN Solutions.
 * User: Mirko Argentino
 * Date: 15/06/2018
 * Time: 12:44
 */
(() => {
  return {
    model: {
      prop: 'value',
      event: 'input'
    },
    props: {
      source: {
        type: Array,
        default(){
          let def = [];
          if ( appui.groups && appui.users ){
            appui.groups.forEach(group => {
              let users = appui.users.filter(u => {
                if ( this.$options.propsData.selfExcluded ){
                  return ((u.id_group === group.id) && (u.value !== appui.user.id));
                }
                return u.id_group === group.id;
              });
              users = users.map(u => {
                let us = Object.assign({icon: 'nf nf-fa-user'}, u);
                us.id = us.value;
                delete us.value;
                return us;
              });
              def.push({
                id: group.id,
                text: group.nom || group.group,
                items: bbn.fn.order(users, 'text'),
                num: users.length,
                icon: 'nf nf-fa-users'
              });
            });
          }
          return bbn.fn.order(def, 'text');
        }
      },
      multi: {
        type: Boolean,
        default: false
      },
      asArray: {
        type: Boolean,
        default(){
          return !!this.$options.propsData.multi;
        }
      },
      selfExcluded: {
        type: Boolean,
        default: false
      },
      value :{
        type: [Array, String]
      },
      scrollable: {
        type: Boolean,
        default: true
      },
      filterable: {
        type: Boolean,
        default: false
      },
      selectedPanel: {
        type: Boolean,
        default: false
      },
      showOnlyNew: {
        type: Boolean,
        default: false
      }
    },
    data(){
      return {
        currentSearch: '',
        originalValue: bbn.fn.extend(true, [], this.value)
      }
    },
    computed: {
      currentSelected(){
        if (!this.showOnlyNew) {
          return this.value;
        }
        return bbn.fn.filter(this.value, v => !this.originalValue.includes(v));
      }
    },
    methods: {
      getUserName: appui.getUserName,
      add(id, check){
        if ( !this.$refs.tree.checked.includes(id) ){
          this.$refs.tree.checked.push(id);
        }
        if ( !this.value.includes(id) ){
          this.value.push(id);
          this.$emit('input', this.value);
        }
      },
      del(id, check){
        if ( this.$refs.tree.checked.includes(id) ){
          this.$refs.tree.checked.splice(this.$refs.tree.checked.indexOf(id), 1);
        }
        if ( this.value.includes(id) ){
          this.value.splice(this.value.indexOf(id), 1);
          this.$emit('input', this.value);
        }
      },
      checkItem(item){
        let idx = bbn.fn.search(this.source, 'id', item);
        if ( (idx > -1) && this.source[idx].items ){
          this.source[idx].items.forEach(u => {
            this.add(u.id);
            this.$emit('check', u.id);
          });
        }
        else {
          this.add(item);
          this.$emit('check', item);
        }
      },
      uncheckItem(item){
        let idx = bbn.fn.search(this.source, 'id', item);
        if ( (idx > -1) && this.source[idx].items ){
          this.source[idx].items.forEach(u => {
            this.del(u.id, true);
            this.$emit('uncheck', u.id);
          });
        }
        else {
          this.$emit('uncheck', item);
          this.del(item);
        }
      },
      selectItem(item){
        if ( !this.multi && !item.items.length && item.data.id ){
          this.$emit('input', this.asArray ? [item.data.id] : item.data.id);
        }
      },
      unselectItem(item){
        if ( !this.multi && !item.items.length && item.data.id ){
          this.$emit('input', this.asArray ? [] : '');
        }
      },
      setChecked(){
        if ( this.multi && Array.isArray(this.value) ){
          if ( this.value.length ){
            this.value.forEach(v => {
              if ( !this.$refs.tree.checked.includes(v) ){
                this.$refs.tree.checked.push(v);
              }
            });
          }
          this.$refs.tree.checked.filter(v => {
            return !this.value.includes(v);
          }).forEach(v => {
            this.$refs.tree.checked.splice(this.$refs.tree.checked.indexOf(v), 1);
          })
        }
      },
      clearSearch(){
        if (this.currentSearch.length) {
          this.currentSearch = '';
        }
      }
    },
    watch: {
      value(){
        this.setChecked();
      },
      currentSearch(newVal){
        return
        let tree = this.getRef('tree');
        if (bbn.cp.isComponent(tree)) {
          let idx = bbn.fn.search(tree.filters.conditions, 'field', 'text');
          if (!!newVal && newVal.length) {
            let obj = {
              field: 'text',
              operator: 'contains',
              value: newVal
            };
            if (idx > -1) {
              tree.filters.conditions.splice(idx, 1, obj);
            }
            else {
              tree.filters.conditions.push(obj);
            }
          }
          else if (idx > -1) {
            tree.filters.conditions.splice(idx, 1);
          }
        }
      }
    }
  }
})();
