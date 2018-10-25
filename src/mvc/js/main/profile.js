// Javascript document
/** @var window.appui */
(() => {
  return {
    methods: {
      checkTheme(res){
        if ( res.success  ){
          if ( this.theme !== this.$refs.form.source.theme ){
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
          appui.success(bbn._('Saved'));
        }
        else{
          appui.error(bbn._('Un problème est survenu'));
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
