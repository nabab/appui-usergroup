// Javascript document
/** @var window.appui */
(function(){
  return {
    methods: {
      checkTheme(res){
        if ( this.theme !== this.$refs.form.source.theme ){
          //bbn.fn.log("POPUP YEAH", this.getPopup());
          this.popup().confirm(
            bbn._("You have changed the theme. Do you want to reload the application in order to use the new theme?"),
            () => {
              document.location.reload();
              this.theme = this.$refs.form.source.theme;
            },
            () => {
              this.theme = this.$refs.form.source.theme;
            },
          );
        }
      }
    },
    data(){
      return {
        theme: this.source.data.theme,
        data: this.source.data,
        themes: appui.themes
      }
  	}
  };
})();