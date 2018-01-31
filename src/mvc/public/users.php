<?php
/** @var \bbn\mvc\controller $ctrl */
/** @var \bbn\user\manager $mgr */
$usr = bbn\user::get_instance();
$arch = $usr->get_class_cfg()['arch']['users'];
if ( !empty($arch) ){
  if ( isset($ctrl->post['limit']) || isset($ctrl->post['action']) ){
    $ctrl->action();
  }
  else{
    $mgr = $ctrl->inc->user->get_manager();
    $ctrl->combo(_("Users' management"), [
      'root' => $ctrl->data['root'],
      'users' => $mgr->get_list(),
      'groups' => $mgr->text_value_groups(),
      'arch' => $ctrl->inc->user->get_class_cfg()['arch']['users'],
      'list' => $mgr->get_list_fields(),
      'is_admin' => $ctrl->inc->user->is_admin()
    ]);
  }
}