(function(){
  return {
    components: {
      'edit-user-form':{
        data(){
          return{
            group : this.source.groups,
          }
        },
        methods:{
          failure(){
            bbn.fn.log("FAILURE", arguments);
          },
          success(){
            /**this method doesn't work*/
            bbn.vue.closest(this, 'bbn-table').updateData();
            this.$refs.form.closePopup(bbn.vue.closest(this, 'bbn-window'));
          },
        },
        template: '#edit-user-form',
        props: ['source'],
      }
    },
    props: ['source'],
    methods: {
      trClass(row){
        return row.admin ? 'w3-black' : '';
      },
      tel_render(row){
        return row.tel.length ? row.tel : '-';
      },
      fonction_render(row){
        return row.fonction.length ? row.fonction : '-'
      },
      email_render(row){
        return row.email.length ? row.email : '-'
      },
      date_render(row){
        return row.last_activity ? row.last_activity : '-';
      },
      remove(row){
        bbn.fn.log('this', arguments, row.id);
        if ( typeof(row.id) !== 'undefined' ){
          bbn.fn.confirm(
            "Etes vous sur de vouloir supprimer cette entrée?",
            () => {
              bbn.fn.post(this.source.root + "actions/users/delete", {id: row.id}, (d) => {
                if ( d.success ){
                  /** @todo here we need a table's method to delete the row from the table*/
                  bbn.fn.log('d', this.source.users)
                }
                else{
                  bbn.fn.log('SOMETHING WENT WRONG')
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
        alert('remove')
      },
      insert(){
        return this.$children[0].edit(null, bbn._("Création d'un user"), { width:'350px', height:'300px' });
      },
      edit(row){
        return this.$children[0].edit(row, bbn._("Modification d'un user"), { width:'350px', height:'300px' });
      },
    },
    
  }
})();