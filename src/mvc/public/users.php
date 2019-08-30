<?php
/** @var \bbn\mvc\controller $ctrl */
/** @var \bbn\user\manager $mgr */
$usr = bbn\user::get_instance();
$arch = $usr->get_class_cfg()['arch']['users'];
if ( !empty($arch) ){
  $mgr = $ctrl->inc->user->get_manager();
  $id_perm = $ctrl->inc->perm->is(APPUI_USERGROUP_ROOT.'permissions');
  $ctrl->combo(_("User Management"), [
    'users' => array_filter($mgr->get_list(), function($a)use($ctrl){
      if ( $ctrl->inc->user->is_admin() ){
        return true;
      }
      if ( $ctrl->inc->user->is_dev() && ($a['id_group'] !== BBN_ADMIN_GROUP) ){
        return true;
      }
      return ($a['id_group'] !== BBN_ADMIN_GROUP) && ($a['id_group'] !== BBN_DEV_GROUP);
    }),
    'groups' => $mgr->text_value_groups(),
    'arch' => $ctrl->inc->user->get_class_cfg()['arch']['users'],
    'list' => $mgr->get_list_fields(),
    'perm_root' => $ctrl->inc->perm->has($id_option) ?
      $ctrl->inc->perm->get_option_root() : false
  ]);
  $ctrl->obj->icon = 'nf nf-fa-user';
}
