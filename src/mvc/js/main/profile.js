// Javascript document
/** @var window.appui */
(() => {
  return {
    methods: {
      checkChanges(res){
        if ( res.success  ){
          appui.success(bbn._('Saved'));
          let lng = this.source.schema.language;
          if (lng && (lng !== this.originalLanguage)) {
            let cookie = bbn.fn.getCookie(bbn.env.appName);
            if (!cookie) {
              cookie = {};
            }

            cookie.locale = lng;
            bbn.fn.setCookie(bbn.env.appName, cookie);
            this.originalLanguage = lng;
          }
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
        themes: appui.themes,
        originalLanguage: this.source.schema && this.source.schema.language ? this.source.schema.language : 'en',
        ready: false
      }
  	},
    mounted(){
      this.ready = true;
    },
    watch: {
      data: {
        deep: true,
        handler(){
          if (this.source.schema.theme === undefined) {
            return;
          }

          const st = '.less,nerd-fonts.css,01-basic.less,02-background.less';
          if ( this.theme !== this.$refs.form.source[this.source.schema.theme] ){
            let lnks = document.head.getElementsByTagName('link');
            let url = false;
            bbn.fn.each(lnks, a => {
              if (
                (a.rel === 'stylesheet')
                && a.href
                && a.href.match(this.theme + st)
              ){
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