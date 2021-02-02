<?php
/** @var \bbn\Mvc\Model $model */
$r = ['success' => false];
/** @var array $cfg */
$cfg = $model->inc->user->getClassCfg();
$id_group = $cfg['arch']['users']['id_group'];
$email = $cfg['arch']['users']['email'];
$id = $cfg['arch']['users']['id'];
/** @var string $admin */
$admin = $cfg['arch']['users']['admin'];
$dev = $cfg['arch']['users']['dev'];
if ( isset($model->data[$id_group]) ){
  if ( empty($model->data[$admin]) || !$model->inc->user->isAdmin() ){
    $model->data[$admin] = 0;
  }
  if ( empty($model->data[$dev]) || !$model->inc->user->isAdmin() ){
    $model->data[$dev] = 0;
  }
  /** @var \bbn\User\Manager $mgr */
  $mgr = $model->inc->user->getManager();
  if ( $user = $mgr->add($model->data) ){
    $r['success'] = true;
    $r['data'] = $user;
    if ($model->hasPlugin('appui-notification')
      && ($notifications = new \bbn\Appui\Notification($model->db))
    ) {
      $notifications->create(
        'users/user_created',
        'User created',
        $model->inc->user->getName().' '._('created a new user').': '.$user[$cfg['show']],
        true,
        _('User created'),
        _('Users'),
        true
      );
    }
  }
}
return $r;