// Javascript Document
(function(){
  return {
    data(){
      return {
        data: {
          current_pass: '',
          pass1: '',
          pass2: ''
        }
      };
    },
    mounted(){
      this.$nextTick(() => {
        bbn.fn.analyzeContent(this.getTab().$el, true);
      })
    }
  };
})()