<?php
/**
 * @var \bbn\mvc\controller $ctrl
 * @var \bbn\user\manager $mgr
 */
$mgr = $ctrl->inc->user->get_manager();
$arch = $ctrl->inc->user->get_class_cfg()['arch']['groups'];
$groups = $mgr->groups();
\bbn\x::sort_by($groups, $arch['group'], 'ASC');
//$ctrl->data['permissions_groups'] = json_encode(\apst\manager::get_all_permissions());
//$user_perm = array_keys($ctrl->inc->user->get_permissions());
$ctrl->combo(_("User Groups"), [
  'root' => APPUI_USERGROUP_ROOT,
  'arch' => $arch,
  'groups' => $groups,
  'is_dev' => $ctrl->inc->user->is_dev(),
  'is_admin' => $ctrl->inc->user->is_admin(),
  'perm_root' => $ctrl->inc->perm->get_option_root(),
  'opt_url' => $ctrl->plugin_url('appui-options'),
  'lng' => [
    'quality' => _("Quality"),
    'new_user' => _("New user"),
    'generate_pdf' => _("Generate a PDF"),
    'name' => _("Name"),
    'fname' => _("First name"),
    'email' => _("Email addresses"),
    'group' => _("Group"),
    'last_seen' => _("Last seen"),
    'actions' => _("Actions"),
    'edit' => _("Edit"),
    'deactivate' => _("Deactivate"),
    'reset_password' => _("Reset password"),
    'manage_user_permissions' => _("Manage user permissions"),
    'email_sent_to' => _("An email has been sent to"),
    'impossible_to_reset' => _("Can not reset password"),
    'sure_to_delete_group' => "Are you sure you want to delete this group?",
    'create_a_new_group_based_on' => "New group with permissions",
    'edit_group' => "Modification du groupe d'utilisateurs",
    'new_group' => "New user group"
  ]
]);
$ctrl->obj->icon = 'fas fa-users';