<?php
if (
  !empty($ctrl->post['action']) && 
  $ctrl->inc->perm->has($ctrl->getPath().'/'.$ctrl->post['action']) 
){  
  $ctrl->action();
}