// Javascript Document
(function(){
  return {
    computed: {
      hasNotifications(){
        return appui && appui.plugins && appui.plugins['appui-notification'];
      }
    }
  };
})()