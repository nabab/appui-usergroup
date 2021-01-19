<?php
/**
 * @var \bbn\mvc\controller $ctrl
 * @var \bbn\user\manager $mgr
 */
$mgr = $ctrl->inc->user->get_manager();
$groups = $mgr->groups();
//$ctrl->data['permissions_groups'] = json_encode(\apst\manager::get_all_permissions());
//$user_perm = array_keys($ctrl->inc->user->get_permissions());
$ctrl->combo(_("User Groups"), [
  'root' => APPUI_USERGROUP_ROOT,
  'groups' => $groups,
  'is_dev' => $ctrl->inc->user->is_dev(),
  'is_admin' => $ctrl->inc->user->is_admin(),
  'perm_root' => $ctrl->inc->perm->get_option_root(),
  'opt_url' => $ctrl->plugin_url('appui-options')
]);
$ctrl->obj->icon = 'nf nf-fa-users';