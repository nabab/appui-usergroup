<?php
$cfg = $model->inc->user->getClassCfg();
if ( isset($model->data['current_pass'], $model->data['pass1'], $model->data['pass2']) ){
  if ( $model->data['pass1'] !== $model->data['pass2'] ){
    return [
      'success' => false,
      'error' => _("The passwords don't match."),
      'errorTitle' => _("Error!")
    ];
  }
  else {
    if ($model->inc->user->setPassword($model->data['current_pass'], $model->data['pass1'])) {
      return [
        'success' => true,
        'error' => _("Password changed."),
        'errorTitle' => _("Success!")
      ];
    }
    else {
      return [
        'success' => false,
        'error' => _("The old password is not recognized."),
        'errorTitle' => _("Error!")
      ];
    }
  }
}
elseif ($model->hasData(['action', $cfg['arch']['users']['id']], true) && ($model->data['action'] === 'magic-link')) {
  $id_user = $model->data[$cfg['arch']['users']['id']];
  $mgr = $model->inc->user->getManager();
  $mgr->expireHotlinks($id_user);
  if ($link = $mgr->createHotlink($id_user)) {
    return [
      'success' => true,
      'link' => $link
    ];
  }
}
elseif (isset($model->data[$cfg['arch']['users']['email']], $model->data[$cfg['arch']['users']['username']]) && \bbn\Str::isEmail($model->data[$cfg['arch']['users']['email']])) {
  $change_theme = $model->data[$cfg['arch']['users']['theme']] !== $model->inc->session->get('theme');
  if ($model->inc->user->updateInfo($model->data) ){
    if ($change_theme) {
      $model->inc->session->set($model->data[$cfg['arch']['users']['theme']], 'theme');
    }

    return [
      'success' => true,
      'error' => _("Successful modification"),
      'errorTitle' => _("Success!")
    ];
  }

  return [
    'success' => false,
    'error' => _("An error occurred during the update."),
    'errorTitle' => _("Error!")
  ];
}
