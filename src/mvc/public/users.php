<?php
/** @var \bbn\mvc\controller $ctrl */
/** @var \bbn\user\manager $mgr */

$usr = bbn\user::get_instance();
$arch = $usr->get_class_cfg()['arch']['users'];
$arch_group = $usr->get_class_cfg()['arch']['groups'];

if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->get_manager();
  $id_perm = $ctrl->inc->perm->is(APPUI_USERGROUP_ROOT.'permissions');
  $users = array_filter($mgr->get_list(), function($a)use($ctrl){
    if ( $ctrl->inc->user->is_admin() ){
      return true;
    }
    if ( $ctrl->inc->user->is_dev() /*&& ((defined('BBN_ADMIN_GROUP')) && ($a['id_group'] !== BBN_ADMIN_GROUP))*/ ){
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
    ->set_icon('nf nf-fa-user')
    ->set_url(APPUI_USERGROUP_ROOT.'users')
    ->combo(_("User Management"), [
      'users' => array_values($users),
      'groups' => $mgr->text_value_groups(),
      'arch' => $arch,
      'arch_group' => $arch_group,
      'list' => $mgr->get_list_fields(),
      'perm_root' => $ctrl->inc->perm->get_option_root()
    ]);
}