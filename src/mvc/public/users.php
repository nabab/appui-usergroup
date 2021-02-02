<?php
/** @var \bbn\Mvc\Controller $ctrl */
/** @var \bbn\User\Manager $mgr */

$usr = bbn\User::getInstance();
$arch = $usr->getClassCfg()['arch']['users'];
$arch_group = $usr->getClassCfg()['arch']['groups'];

if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->getManager();
  $id_perm = $ctrl->inc->perm->is(APPUI_USERGROUP_ROOT.'permissions');
  $users = array_filter($mgr->getList(), function($a)use($ctrl){
    if ( $ctrl->inc->user->isAdmin() ){
      return true;
    }
    if ( $ctrl->inc->user->isDev() /*&& ((defined('BBN_ADMIN_GROUP')) && ($a['id_group'] !== BBN_ADMIN_GROUP))*/ ){
      return true;
    }
    return ((defined('BBN_ADMIN_GROUP')) && ($a['id_group'] !== BBN_ADMIN_GROUP)) && (defined('BBN_DEV_GROUP') && ($a['id_group'] !== BBN_DEV_GROUP));
  });
  $now = new DateTime();
  foreach($users as &$user){
    $user['session'] = false;
    if( $user['last_activity'] !== null ){
      $activity = new DateTime($user['last_activity']);
      $diff = $activity->diff($now);
      $interval = ($diff->days * 24 * 60) + ($diff->h * 60) + $diff->i;
        if ( ($interval >= 0) && ($interval <= 2) ){
        $user['session'] = true;
      }
    }
  }
  $ctrl
    ->setIcon('nf nf-fa-user')
    ->setUrl(APPUI_USERGROUP_ROOT.'users')
    ->combo(_("User Management"), [
      'users' => array_values($users),
      'groups' => $mgr->textValueGroups(),
      'arch' => $arch,
      'arch_group' => $arch_group,
      'list' => $mgr->getListFields(),
      'perm_root' => $ctrl->inc->perm->getOptionRoot()
    ]);
}