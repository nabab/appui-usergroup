<?php
/** @var \bbn\User\Manager $mgr */


$usr = $model->inc->user;
$arch = $usr->getClassCfg()['arch']['users'];
$archGroups = $usr->getClassCfg()['arch']['groups'];

if ($usr->check() && !empty($arch)) {
  $mgr = $model->inc->user->getManager();
  $groups = array_values(array_filter($mgr->groups(), function($g) use($archGroups, $model){
    if ($model->inc->user->isAdmin() || $model->inc->user->isDev()) {
      return true;
    }
    return ($g[$archGroups['type']] !== 'internal')
      && ($g[$archGroups['type']] !== 'api')
      && (!defined('BBN_ADMIN_GROUP') || ($g[$archGroups['id']] !== BBN_ADMIN_GROUP))
      && (!defined('BBN_DEV_GROUP') || ($g[$archGroups['id']] !== BBN_DEV_GROUP));
  }));
  $users = array_filter($mgr->getList(), function($a) use($model, $groups, $archGroups){
    if ($model->inc->user->isAdmin() || $model->inc->user->isDev()) {
      return true;
    }
    return (\bbn\X::search($groups, [$archGroups['id'] => $a['id_group']]) !== null)
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
  $pluginUrl = $model->pluginUrl('appui-usergroup');
  $insertPerm = $model->inc->perm->has($model->inc->perm->fromPath($pluginUrl . '/actions/users/insert'));
  $updatePerm = $model->inc->perm->has($model->inc->perm->fromPath($pluginUrl . '/actions/users/update'));
  $idTheme = $model->inc->options->fromCode('themes', 'core', 'appui');
  return [
    'themes' => $model->inc->options->textValueOptions($idTheme),
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
    'perm_root' => $model->inc->options->fromCode('permissions'),
    'permissionsSources' => $model->inc->perm->getSources(false),
    'permissionsAccess' => $model->inc->options->fromCode('access', 'permissions'),
    'permissionsOptions' => $model->inc->options->fromCode('options', 'permissions'),
    'permissions' => [
      'insert' => $insertPerm,
      'update' => $updatePerm,
      'delete' => $model->inc->perm->has($model->inc->perm->fromPath($pluginUrl . '/actions/users/delete')),
      'init' => $model->inc->perm->has($model->inc->perm->fromPath($pluginUrl . '/actions/users/init')),
      'permissions' => !empty($insertPerm) || !empty($updatePerm)
    ]
  ];
}