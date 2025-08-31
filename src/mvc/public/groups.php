<?php
/**
 * @var bbn\Mvc\Controller $ctrl
 * @var \bbn\User\Manager $mgr
 */
$mgr = $ctrl->inc->user->getManager();
$groups = $mgr->groups();
$groupArch = $ctrl->inc->user->getClassCfg()['arch']['groups'];
//$user_perm = array_keys($ctrl->inc->user->get_permissions());
if ($ctrl->hasPlugin('appui-dashboard')) {
  $hasDash = true;
  $dashDefId = $ctrl->inc->options->fromCode('default', 'dashboard', 'appui');
  $prefCfg = $ctrl->inc->pref->getClassCfg();
}
if ($ctrl->hasPlugin('appui-menu')) {
  $hasMenu = true;
  $MenuDefId = $ctrl->inc->options->fromCode('default', 'menu', 'appui');
  $prefCfg = $ctrl->inc->pref->getClassCfg();
}
foreach ($groups as $i => $g) {
  if (!empty($hasDash)) {
    $groups[$i]['default_dashboard'] = $ctrl->db->selectOne($prefCfg['table'], $prefCfg['arch']['user_options']['id_alias'], [
      $prefCfg['arch']['user_options']['id_group'] => $g[$groupArch['id']],
      $prefCfg['arch']['user_options']['id_option'] => $dashDefId
    ]);
  }
  if ($ctrl->hasPlugin('appui-menu')) {
    $groups[$i]['default_menu'] = $ctrl->db->selectOne($prefCfg['table'], $prefCfg['arch']['user_options']['id_alias'], [
      $prefCfg['arch']['user_options']['id_group'] => $g[$groupArch['id']],
      $prefCfg['arch']['user_options']['id_option'] => $MenuDefId
    ]);
  }
}
$pluginUrl = $ctrl->pluginUrl('appui-usergroup');
$insertPerm = $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/groups/insert'));
$updatePerm = $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/groups/update'));
$ctrl->combo(_("User Groups"), [
  'root' => APPUI_USERGROUP_ROOT,
  'groups' => $groups,
  'arch' => $ctrl->inc->user->getClassCfg()['arch'],
  'is_dev' => $ctrl->inc->user->isDev(),
  'is_admin' => $ctrl->inc->user->isAdmin(),
  'perm_root' => $ctrl->inc->perm->getOptionRoot(),
  'permissions' => [
    'insert' => $insertPerm,
    'update' => $updatePerm,
    'delete' => $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/groups/delete')),
    'permissions' => !empty($insertPerm) || !empty($updatePerm)
  ],
  'permissionsSources' => $ctrl->inc->perm->getSources(false),
  'permissionsAccess' => $ctrl->inc->options->fromCode('access', 'permissions', 'appui'),
  'permissionsOptions' => $ctrl->inc->options->fromCode('options', 'permissions', 'appui'),
  'opt_url' => $ctrl->pluginUrl('appui-option'),
  'menus' => !empty($hasMenu) ? $ctrl->db->selectAll($prefCfg['table'], [
    'text' => $prefCfg['arch']['user_options']['text'],
    'value' => $prefCfg['arch']['user_options']['id']
  ], [
    $prefCfg['arch']['user_options']['id_option'] => $ctrl->inc->options->fromCode('menus', 'menu', 'appui'),
    $prefCfg['arch']['user_options']['id_alias'] => NULL
  ]) : [],
  'dashboards' => !empty($hasDash) ? $ctrl->db->selectAll($prefCfg['table'], [
    'text' => $prefCfg['arch']['user_options']['text'],
    'value' => $prefCfg['arch']['user_options']['id']
  ], [
    $prefCfg['arch']['user_options']['id_option'] => $ctrl->inc->options->fromCode('list', 'dashboard', 'appui'),
    $prefCfg['arch']['user_options']['id_alias'] => NULL
  ]) : []
]);
$ctrl->obj->icon = 'nf nf-fa-users';