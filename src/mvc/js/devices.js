(() => {
  return {
    mixins: [bbn.cp.mixins.basic],
    data(){
      return {
        currentStart: bbn.date().format('YYYY') + '-01-01',
        currentEnd: bbn.date().format('YYYY-MM-DD'),
        currentData: false,
        isLoading: false
      }
    },
    computed: {
      desktopDevices(){
        const r = {
          os: [],
          browser: [],
          total: this.currentData?.desktop?.length || 0,
        };
        bbn.fn.each(this.currentData?.desktop, d => {
          let os = bbn.fn.getRow(r.os, 'name', d.os);
          if (!os){
            os = {
              name: d.os,
              version: [],
              total: 0
            };
            r.os.push(os);
          }

          os.total++;
          let osVersion = bbn.fn.getRow(os.version, 'name', d.osVersion);
          if (!osVersion){
            osVersion = {
              name: d.osVersion,
              total: 0,
            };
            os.version.push(osVersion);
          }

          osVersion.total++;
          let browser = bbn.fn.getRow(r.browser, 'name', d.browser);
          if (!browser){
            browser = {
              name: d.browser,
              version: [],
              total: 0
            };
            r.browser.push(browser);
          }

          browser.total++;
          let browserVersion = bbn.fn.getRow(browser.version, 'name', d.browserVersion);
          if (!browserVersion){
            browserVersion = {
              name: d.browserVersion,
              total: 0,
            };
            browser.version.push(browserVersion);
          }

          browserVersion.total++;
        });
        bbn.fn.each(r.os, os => {
          os.version = bbn.fn.order(os.version, 'total', 'desc');
        });
        r.os = bbn.fn.order(r.os, 'total', 'desc');
        bbn.fn.each(r.browser, browser => {
          browser.version = bbn.fn.order(browser.version, 'total', 'desc');
        });
        r.browser = bbn.fn.order(r.browser, 'total', 'desc');
        return r;
      },
      mobileDevices(){
        const r = {
          os: [],
          browser: [],
          total: this.currentData?.mobile?.length || 0,
        };
        bbn.fn.each(this.currentData?.mobile, d => {
          let os = bbn.fn.getRow(r.os, 'name', d.os);
          if (!os){
            os = {
              name: d.os,
              version: [],
              total: 0
            };
            r.os.push(os);
          }

          os.total++;
          let osVersion = bbn.fn.getRow(os.version, 'name', d.osVersion);
          if (!osVersion){
            osVersion = {
              name: d.osVersion,
              total: 0,
            };
            os.version.push(osVersion);
          }

          osVersion.total++;
          let browser = bbn.fn.getRow(r.browser, 'name', d.browser);
          if (!browser){
            browser = {
              name: d.browser,
              version: [],
              total: 0
            };
            r.browser.push(browser);
          }

          browser.total++;
          let browserVersion = bbn.fn.getRow(browser.version, 'name', d.browserVersion);
          if (!browserVersion){
            browserVersion = {
              name: d.browserVersion,
              total: 0,
            };
            browser.version.push(browserVersion);
          }

          browserVersion.total++;
        });
        bbn.fn.each(r.os, os => {
          os.version = bbn.fn.order(os.version, 'total', 'desc');
        });
        r.os = bbn.fn.order(r.os, 'total', 'desc');
        bbn.fn.each(r.browser, browser => {
          browser.version = bbn.fn.order(browser.version, 'total', 'desc');
        });
        r.browser = bbn.fn.order(r.browser, 'total', 'desc');
        return r;
      },
      tabletDevices(){
        const r = {
          os: [],
          browser: [],
          total: this.currentData?.tablet?.length || 0,
        };
        bbn.fn.each(this.currentData?.tablet, d => {
          let os = bbn.fn.getRow(r.os, 'name', d.os);
          if (!os){
            os = {
              name: d.os,
              version: [],
              total: 0
            };
            r.os.push(os);
          }

          os.total++;
          let osVersion = bbn.fn.getRow(os.version, 'name', d.osVersion);
          if (!osVersion){
            osVersion = {
              name: d.osVersion,
              total: 0,
            };
            os.version.push(osVersion);
          }

          osVersion.total++;
          let browser = bbn.fn.getRow(r.browser, 'name', d.browser);
          if (!browser){
            browser = {
              name: d.browser,
              version: [],
              total: 0
            };
            r.browser.push(browser);
          }

          browser.total++;
          let browserVersion = bbn.fn.getRow(browser.version, 'name', d.browserVersion);
          if (!browserVersion){
            browserVersion = {
              name: d.browserVersion,
              total: 0,
            };
            browser.version.push(browserVersion);
          }

          browserVersion.total++;
        });
        bbn.fn.each(r.os, os => {
          os.version = bbn.fn.order(os.version, 'total', 'desc');
        });
        r.os = bbn.fn.order(r.os, 'total', 'desc');
        bbn.fn.each(r.browser, browser => {
          browser.version = bbn.fn.order(browser.version, 'total', 'desc');
        });
        r.browser = bbn.fn.order(r.browser, 'total', 'desc');
        return r;
      }
    },
    methods: {
      loadData(){
        if (this.currentStart && this.currentEnd){
          this.currentData = [];
          this.isLoading = true;
          this.post(appui.plugins['appui-usergroup'] + '/devices', {
            start: this.currentStart,
            end: this.currentEnd
          }, d => {
            if (d.success) {
              this.currentData = d.data;
            }
            else {
              appui.error(bbn._("An error occurred while loading data"));
            }

            this.isLoading = false;
          }, () => {
            this.isLoading = false;
          });
        }
      }
    }
  }
})();