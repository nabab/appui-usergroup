<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $this \bbn\mvc\controller */
if ( isset($ctrl->post['current_pass'], $ctrl->post['pass1'], $ctrl->post['pass2']) ){
  if ( $ctrl->post['pass1'] !== $ctrl->post['pass2'] ){
    $ctrl->obj->success = false;
    $ctrl->obj->error = _("The passwords don't match.");
    $ctrl->obj->errorTitle = _("Error!");
  }
  else{
    if ( $ctrl->obj->success = $ctrl->inc->user->set_password($ctrl->post['current_pass'], $ctrl->post['pass1']) ){
      $ctrl->obj->error = _("Password changed.");
      $ctrl->obj->errorTitle = _("Success!");
    }
    else{
      $ctrl->obj->error = _("The old password is not recognized.");
      $ctrl->obj->errorTitle = _("Error!");
    }
  }
}
else if ( 
  ($cfg = $ctrl->inc->user->get_class_cfg()) &&
  isset($ctrl->post[$cfg['arch']['users']['email']], $ctrl->post[$cfg['arch']['users']['username']]) && \bbn\str::is_email($ctrl->post[$cfg['arch']['users']['email']])
){
  $change_theme = $ctrl->post[$cfg['arch']['users']['theme']] !== $ctrl->inc->session->get('theme');
  if ( $ctrl->obj->success = $ctrl->inc->user->update_info($ctrl->post) ){
    if ( $change_theme ){
      $ctrl->inc->session->set($ctrl->post[$cfg['arch']['users']['theme']], 'theme');
    }
    else{
      $ctrl->obj->error = _("Successful modification");
      $ctrl->obj->errorTitle = _("Success!");
    }
  }
}