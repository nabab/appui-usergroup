<?php
/** @var \bbn\Mvc\Controller $ctrl */
/** @var \bbn\User\Manager $mgr */

$usr = bbn\User::getInstance();
$arch = $usr->getClassCfg()['arch']['users'];
$archGroups = $usr->getClassCfg()['arch']['groups'];

if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->getManager();
  $groups = array_values(array_filter($mgr->groups(), function($g) use($archGroups, $ctrl){
    if ($ctrl->inc->user->isAdmin() || $ctrl->inc->user->isDev()) {
      return true;
    }
    return ($g[$archGroups['type']] !== 'internal')
      && ($g[$archGroups['type']] !== 'api')
      && (!defined('BBN_ADMIN_GROUP') || ($g[$archGroups['id']] !== BBN_ADMIN_GROUP))
      && (!defined('BBN_DEV_GROUP') || ($g[$archGroups['id']] !== BBN_DEV_GROUP));
  }));
  $users = array_filter($mgr->getList(), function($a) use($ctrl, $groups, $archGroups){
    if ($ctrl->inc->user->isAdmin() || $ctrl->inc->user->isDev()) {
      return true;
    }
    return (\bbn\X::find($groups, [$archGroups['id'] => $a['id_group']]) !== null)
      && (!defined('BBN_ADMIN_GROUP') || ($a['id_group'] !== BBN_ADMIN_GROUP))
      && (!defined('BBN_DEV_GROUP') || ($a['id_group'] !== BBN_DEV_GROUP));
  });
  $now = new DateTime();
  foreach($users as &$user){
    $user['session'] = false;
    if ($user['last_activity'] !== null) {
      if ((time() - strtotime($user['last_activity'])) < 1200) {
        $user['session'] = true;
      }
      $activity = new DateTime($user['last_activity']);
    }
  }
  $pluginUrl = $ctrl->pluginUrl('appui-usergroup');
  $insertPerm = $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/users/insert'));
  $updatePerm = $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/users/update'));
  $ctrl
    ->setIcon('nf nf-fa-user')
    ->setUrl(APPUI_USERGROUP_ROOT.'users')
    ->combo(_("User Management"), [
      'users' => array_values($users),
      'groups' => array_map(function($g) use($archGroups){
        return [
          'text' => $g[$archGroups['group']],
          'value' => $g[$archGroups['id']],
          'type' => $g[$archGroups['type']]
        ];
      }, $groups),
      'arch' => $arch,
      'arch_group' => $archGroups,
      'list' => $mgr->getListFields(),
      'perm_root' => $ctrl->inc->perm->getOptionRoot(),
      'permissionsSources' => $ctrl->inc->perm->getSources(false),
      'permissionsAccess' => $ctrl->inc->options->fromCode('access', 'permissions', 'appui'),
      'permissionsOptions' => $ctrl->inc->options->fromCode('options', 'permissions', 'appui'),
      'permissions' => [
        'insert' => $insertPerm,
        'update' => $updatePerm,
        'delete' => $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/users/delete')),
        'init' => $ctrl->inc->perm->has($ctrl->inc->perm->fromPath($pluginUrl . '/actions/users/init')),
        'permissions' => !empty($insertPerm) || !empty($updatePerm)
      ]
    ]);
}