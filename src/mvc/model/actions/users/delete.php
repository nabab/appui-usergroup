<?php
/** @var bbn\Mvc\Model $model */
/** @var \bbn\User\Manager $mgr */
$r = ['success' => false];
$cfg = $model->inc->user->getClassCfg();
$id_field = $cfg['arch']['users']['id'];
if ( !empty($model->data[$id_field]) &&
  ($mgr = $model->inc->user->getManager()) &&
  ($user = $mgr->getUser($model->data[$id_field])) &&
  empty($user['admin'])
){
  $r['success'] = $mgr->deactivate($model->data[$id_field]);
  $r['data'][$id_field] = $model->data[$id_field];
  if ($model->hasPlugin('appui-notification')
    && ($notifications = new \bbn\Appui\Notification($model->db))
  ) {
    $notifications->create(
      'users/user_deleted',
      'User deleted',
      $model->inc->user->getName().' '._('deleted the user').' '.$user[$cfg['show']],
      true,
      _('User deleted'),
      _('Users'),
      true
    );
  }
}
return $r;