<?php
if (
  !empty($ctrl->post['action']) && 
  $ctrl->inc->perm->has($ctrl->get_path().'/'.$ctrl->post['action']) 
){  
  $ctrl->action();
}