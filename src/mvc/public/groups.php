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
  'root' => APPUI_USERGROUP_ROOT,
  'arch' => $arch,
  'groups' => $groups,
  'is_dev' => $ctrl->inc->user->is_dev(),
  'is_admin' => $ctrl->inc->user->is_admin(),
  'perm_root' => $ctrl->inc->perm->get_option_root(),
  'opt_url' => $ctrl->plugin_url('appui-options'),
  'lng' => [
    'quality' => _("Qualité"),
    'new_user' => _("Nouvel utilisateur"),
    'generate_pdf' => _("Générer un PDF"),
    'name' => _("Nom"),
    'fname' => _("Prénom"),
    'email' => _("Adresses eMail"),
    'group' => _("Groupe"),
    'last_seen' => _("Vu pour la dernière fois"),
    'actions' => _("Actions"),
    'edit' => _("Modifier"),
    'deactivate' => _("Désactiver"),
    'reset_password' => _("Réinitialiser le mot de passe"),
    'manage_user_permissions' => _("Gérer les permissions de l'utilisateur"),
    'email_sent_to' => _("Un eMail vient d'être envoyé à "),
    'impossible_to_reset' => _("Impossible de réinitialiser le mnot de passe"),
    'sure_to_delete_group' => "Êtes-vous sûr de vouloir supprimer ce groupe?",
    'create_a_new_group_based_on' => "Nouveau groupe avec les permissions de",
    'edit_group' => "Modification du groupe d'utilisateurs",
    'new_group' => "Nouveau groupe d'utilisateurs"
  ]
]);
$ctrl->obj->icon = 'fa fa-group';
