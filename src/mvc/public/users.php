<?php
/** @var \bbn\mvc\controller $ctrl */
/** @var \bbn\user\manager $mgr */
$usr = bbn\user::get_instance();
$arch = $usr->get_class_cfg()['arch']['users'];
if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->get_manager();
  $ctrl->combo(_("Users' management"), [
    'root' => $ctrl->data['root'],
    'users' => $mgr->get_list(),
    'groups' => $mgr->text_value_groups(),
    'arch' => $ctrl->inc->user->get_class_cfg()['arch']['users'],
    'list' => $mgr->get_list_fields(),
    'is_dev' => $ctrl->inc->user->is_dev(),
    'is_admin' => $ctrl->inc->user->is_admin(),
    'perm_root' => $ctrl->inc->perm->get_option_root(),
    'opt_url' => $ctrl->plugin_url('appui-options')
  ]);
  $ctrl->obj->icon = 'fa fa-user';
}