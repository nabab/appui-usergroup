// Javascript Document
(function(){
  return {
    data(){
      return {
        data: {
          current_pass: '',
          pass1: '',
          pass2: ''
        },
        root: appui.plugins['appui-usergroup']+'/'
      };
    },
    methods:{ 
      validForm(d){
        if ( d.pass1 === d.pass2 ){
          return true;
        }
        else{
          return false;
        }
      },
      success(d){
        if(d.success){
          appui.success(bbn._('Password successfully changed'))
        }
        else{
          appui.error('Something went wrong')
        }
      }
    }
  };
})()