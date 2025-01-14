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
        this.post(this.source.root + 'preferences', {id: data.id}, (d) => {
          if ( d && d.data ){
            this.getPopup({
              component: {
                template: '<bbn-json-editor :value="jsonSource" :readonly="true" class="bbn-overlay"></bbn-json-editor>',
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
              label: bbn._("Setting preferences")
            });
          }
        })
        bbn.fn.log("VIEW", data)
      },
      del(data, col, index){
        bbn.fn.log("DELETE", arguments)
        this.post(this.source.root + 'actions/preferences/delete', {id: data.id}, d => {
          if ( d.success ){
            appui.success();
            this.getRef('table').delete(index, false);
          }
          else{
            appui.error()
          }
        })
      }
    }
  };
})()
