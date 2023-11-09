((data) => {
  return {
    data() {
      return {
        root: appui.plugins['appui-usergroup'] + '/',
        userMenu: [{
          action(){
            bbn.fn.toggleFullScreen();
          },
          text: bbn._("Full screen"),
          icon: 'nf nf-fa-arrows_alt'
        }, {
          action(){
            appui.getPopup().load({
              url: appui.plugins['appui-core'] + 'help',
              width: '90%',
              height: '90%',
              scrollable: false
            });
          },
          text: bbn._("Help"),
          icon: 'nf nf-mdi-help_circle_outline'
        }, {
          url: appui.plugins['appui-usergroup'] + '/main',
          text: bbn._("My profile"),
          icon: 'nf nf-fa-user'
        }, {
          text: bbn._("Log out"),
          icon: 'nf nf-fa-sign_out',
          action(){
            bbn.fn.post(appui.plugins['appui-core'] + '/logout').then(() => {
              document.location.reload();
            });
          }
        }]
      };
    },
    methods: {
      show() {
        this.searchOn = true;
      }
    },
    mounted() {
      //bbn.fn.log(["USER APP-UI", this.source, data]);
    },
    watch: {
    }
  }
})(data);
