// Javascript document
/** @var window.appui */
(function(){
  return {
    methods: {
      checkTheme(res){
        if ( this.theme !== this.$refs.form.source.theme ){
          //bbn.fn.log("POPUP YEAH", this.getPopup());
          this.getPopup().confirm(
            bbn._("Vous venez de changer le thème. Voulez-vous rafraîchir l'application afin d'appliquer le nouveau thème?"),
            () => {
              this.theme = this.$refs.form.source.theme;
              document.location.reload();
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