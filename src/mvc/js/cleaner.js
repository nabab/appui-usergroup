// Javascript Document

(() => {
  return {
    data() {
      return {
        selected: [],
        results: null
      }
    },
    methods: {
      onUncheck() {
        bbn.fn.log(arguments);
      },
      onCheck() {
        bbn.fn.log(arguments);
      },
      onChange(checked, cb) {
        bbn.fn.log(cb.label, cb.value, checked);
      },
      launch() {
        bbn.fn.post(appui.plugins['appui-usergroup'] + '/cleaner', {launch: true}, d => {
          if (d.res) {
            this.results = d.res;
          }
        })
      }
    }
  }
})();