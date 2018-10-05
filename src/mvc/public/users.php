<?php
/** @var \bbn\mvc\controller $ctrl */
/** @var \bbn\user\manager $mgr */
$usr = bbn\user::get_instance();
$arch = $usr->get_class_cfg()['arch']['users'];
if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->get_manager();
  $ctrl->combo(_("Gestion des utilisateurs"), [
    'users' => $mgr->get_list(),
    'groups' => $mgr->text_value_groups(),
    'arch' => $ctrl->inc->user->get_class_cfg()['arch']['users'],
    'list' => $mgr->get_list_fields(),
    'perm_root' => $ctrl->inc->perm->get_option_root(),
  ]);
  $ctrl->obj->icon = 'fas fa-user';
}