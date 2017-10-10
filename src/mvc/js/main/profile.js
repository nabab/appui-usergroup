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
        themes: [
          {
            "value": "uniform",
            "text": "Uniform"
          }, {
            "value": "black",
            "text": "Black"
          }, {
            "value": "blueopal",
            "text": "Blue Opal"
          }, {
            "value": "bootstrap",
            "text": "Bootstrap"
          }, {
            "value": "default",
            "text": "Default"
          }, {
            "value": "fiori",
            "text": "Fiori"
          }, {
            "value": "flat",
            "text": "Flat"
          }, {
            "value": "highcontrast",
            "text": "High Contrast"
          }, {
            "value": "material",
            "text": "Material"
          }, {
            "value": "materialblack",
            "text": "Material Black"
          }, {
            "value": "metro",
            "text": "Metro"
          }, {
            "value": "metroblack",
            "text": "Metro Black"
          }, {
            "value": "moonlight",
            "text": "Moonlight"
          }, {
            "value": "nova",
            "text": "Nova"
          }, {
            "value": "office365",
            "text": "Office 365"
          }, {
            "value": "silver",
            "text": "Silver"
          }
        ]
      }
  	}
  };
})();