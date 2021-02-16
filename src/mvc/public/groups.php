<?php
/**
 * @var \bbn\Mvc\Controller $ctrl
 * @var \bbn\User\Manager $mgr
 */
$mgr = $ctrl->inc->user->getManager();
$groups = $mgr->groups();
//$ctrl->data['permissions_groups'] = json_encode(\apst\manager::get_all_permissions());
//$user_perm = array_keys($ctrl->inc->user->get_permissions());
$ctrl->combo(_("User Groups"), [
  'root' => APPUI_USERGROUP_ROOT,
  'groups' => $groups,
  'arch' => $ctrl->inc->user->getClassCfg()['arch'],
  'is_dev' => $ctrl->inc->user->isDev(),
  'is_admin' => $ctrl->inc->user->isAdmin(),
  'perm_root' => $ctrl->inc->perm->getOptionRoot(),
  'opt_url' => $ctrl->pluginUrl('appui-option')
]);
$ctrl->obj->icon = 'nf nf-fa-users';