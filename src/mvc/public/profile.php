<?php
if ( isset($ctrl->post['current_pass'], $ctrl->post['pass1'], $ctrl->post['pass2']) ){
  if ( $ctrl->post['pass1'] !== $ctrl->post['pass2'] ){
    $ctrl->obj->error = "Les mots de passe ne correspondent pas.";
    $ctrl->obj->errorTitle = "Échec!";
  }
  else{
    if ( $ctrl->obj->res = $ctrl->inc->user->set_password($ctrl->post['current_pass'], $ctrl->post['pass1']) ){
      $ctrl->obj->error = "Mot de passe modifié";
      $ctrl->obj->errorTitle = "Succès!";
    }
    else{
      $ctrl->obj->error = "L'ancien mot de passe n'est pas reconnu.";
      $ctrl->obj->errorTitle = "Échec!";
    }
  }
}
else if ( isset($ctrl->post['email'], $ctrl->post['nom']) && \bbn\str::is_email($ctrl->post['email']) ){
  $change_theme = $ctrl->post['theme'] !== $ctrl->inc->session->get('info', 'theme');
  if ( $ctrl->obj->res = $ctrl->inc->user->update_info($ctrl->post) ){
    $ctrl->obj->error = "Modification réussie";
    $ctrl->obj->errorTitle = "Succès!";
    if ( $change_theme ){
      $ctrl->add_script(<<<'EOF'
appui.fn.confirm("Pour que le nouveau thème soit appliqué, il vous faut recharger l'application.\nVouslez-vous la recharger maintenant?", function(){
  document.location.reload();
});
EOF
      );
    }
  }
}
else{
  $ctrl->combo(_("Mon profil"), $ctrl->inc->user->get_session());
}
