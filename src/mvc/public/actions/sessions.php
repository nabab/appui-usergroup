<?php
if ( isset($ctrl->arguments[0]) && ($ctrl->arguments[0] === 'close')){   
  $ctrl->action();
}
else{
  $ctrl->obj->success = false;
}  