// Javascript Document

(() => {
  return {
    data() {
      return {
        root: appui.plugins['appui-usergroup'] + '/'
      }
    },
    methods: {
      renderPost(row) {
        if (!row.post) {
          return '-'
        }

        try {
          const parsed = JSON.parse(row.post);
          return parsed.join(', ');
        }
        catch (e) {
          return '-';
        }
      }
    }
  }
})();
