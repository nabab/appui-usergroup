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
$ctrl->combo(_("Groupes d'utilisateurs"), [
  'root' => $ctrl->data['root'],
  'arch' => $arch,
  'groups' => $groups,
  'is_dev' => $ctrl->inc->user->is_dev(),
  'is_admin' => $ctrl->inc->user->is_admin(),
  'perm_root' => $ctrl->inc->perm->get_option_root(),
  'lng' => [
    'quality' => _("Quality"),
    'new_user' => _("New user"),
    'generate_pdf' => _("Generate a PDF"),
    'name' => _("Name"),
    'fname' => _("First name"),
    'email' => _("eMail address"),
    'group' => _("Group"),
    'last_seen' => _("Last seen"),
    'actions' => _("Actions"),
    'edit' => _("Edit"),
    'deactivate' => _("Deactivate"),
    'reset_password' => _("Reset password"),
    'manage_user_permissions' => _("Manage user's specific permissions"),
    'email_sent_to' => _("An eMail has just been sent to "),
    'impossible_to_reset' => _("Impossible to reset the user's password"),
    'sure_to_delete_group' => "Êtes-vous sûr de vouloir supprimer ce groupe?",
    'create_a_new_group_based_on' => "Nouveau groupe avec les permissions de",
    'edit_group' => "Modification du groupe d'utilisateurs",
    'new_group' => "Nouveau groupe d'utilisateurs"
  ]
]);
$ctrl->obj->icon = 'fa fa-group';
