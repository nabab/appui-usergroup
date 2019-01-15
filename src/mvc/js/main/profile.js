// Javascript document
/** @var window.appui */
(() => {
  return {
    methods: {
      checkTheme(res){
        if ( res.success  ){
          if ( this.theme !== this.$refs.form.source[this.source.schema.theme] ){
            this.getPopup().confirm(
              bbn._("You have changed the theme. Do you want to refresh the application to apply the new theme?"),
              () => {
                this.theme = this.$refs.form.source[this.source.schema.theme];
                document.location.reload();
              },
              () => {
                this.theme = this.$refs.form.source[this.source.schema.theme];
              },
            );
          }
          appui.success(bbn._('Saved'));
        }
        else{
          appui.error();
        }
      }
    },
    data(){
      return {
        theme: this.source.data[this.source.schema.theme],
        data: this.source.data,
        themes: appui.themes
      }
  	}
  };
})();
