// Javascript document
/** @var window.appui */
(() => {
  return {
    methods: {
      checkTheme(res){
        if ( res.success  ){
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
  	},
    watch: {
      data: {
        deep: true,
        handler(){
          if (this.source.schema.theme === undefined) {
            return;
          }

          const st = '.less,01-basic.less,02-background.less';
          bbn.fn.log("DIRTY HANDLER", this.theme, this.source.schema.theme, this.$refs.form.source[this.source.schema.theme]);
          if ( this.theme !== this.$refs.form.source[this.source.schema.theme] ){
            bbn.fn.log("YEAD");
            let lnks = document.head.getElementsByTagName('link');
            let url = false;
            bbn.fn.each(lnks, a => {
              if (
                (a.rel === 'stylesheet')
                && a.href
                && a.href.match(this.theme + st)
              ){
                bbn.fn.log("CSS FOUND");
                a.href = bbn.fn.replaceAll(
                  this.theme + st,
                  this.$refs.form.source[this.source.schema.theme] + st,
                  a.href
                );
                this.theme = this.$refs.form.source[this.source.schema.theme];
                return false;
              }
            })
          }
        }
      }
    }
  };
})();