<?php
/**
 * @var \bbn\mvc\controller $ctrl
 * @var \bbn\user\manager $mgr
 */
$mgr = $ctrl->inc->user->get_manager();
$usr = \bbn\user\connection::get_user();
$ctrl->combo(_("Users' management"), [
  'root' => $ctrl->data['root'],
  'users' => $mgr->get_list(),
  'groups' => $mgr->text_value_groups(),
  'arch' => $ctrl->inc->user->get_class_cfg()['arch']['users'],
  'list' => $mgr->get_list_fields(),
  'is_admin' => $ctrl->inc->user->is_admin(),
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
    'impossible_to_reset' => _("Impossible to reset the user's password")
  ]
]);
