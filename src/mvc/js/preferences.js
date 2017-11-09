// Javascript Document

(function(){
  return {
    methods: {
      showOption(data){
        return '<a href="' + this.source.options_root + 'list/' + data.id_parent + '">' + data.option + '</a>';
      },
      showText(data){
        return data.text ? data.text : '-';
      },
      showLink(data){
        return data.id_link ? ('<a href="' + this.source.options_root + 'list/' + data.id_link + '">' + data.link + '</a>') : '-';
      },
      view(data){
        bbn.fn.post(this.source.root + 'preferences', {id: data.id}, (d) => {
          if ( d && d.data ){
            this.getTab().getPopup().open({
              component: {
                template: '<bbn-json-editor :value="jsonSource" :readonly="true" class="bbn-full-screen"></bbn-json-editor>',
                props: ['source'],
                computed: {
                  jsonSource(){
                    return this.source ? JSON.stringify(this.source) : '{}'
                  }
                }
              },
              source: d.data,
              width: 500,
              height: 500,
              title: bbn._("Preference configuration")
            });
          }
        })
        bbn.fn.log("VIEW", data)
      },
      delete(data){
        bbn.fn.log("DELETE", data)
      }
    }
  };
})()