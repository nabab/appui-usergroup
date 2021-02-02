<?php
/** @var \bbn\Mvc\Model $model */
$r = ['success' => false];

/** @var array $cfg */
$cfg = $model->inc->user->getClassCfg();
/** @var string $id_group */
$id_group = $cfg['arch']['users']['id_group'];
/** @var string $email */
$email = $cfg['arch']['users']['email'];
/** @var string $admin */
$admin = $cfg['arch']['users']['admin'];
/** @var string $dev */
$dev = $cfg['arch']['users']['dev'];
/** @var string $id */
$id = $cfg['arch']['users']['id'];

if ( isset($model->data[$id], $model->data[$id_group], $model->data[$email], $model->data[$admin], $model->data[$dev]) &&
  ($mgr = $model->inc->user->getManager()) &&
  ($user = $mgr->getUser($model->data[$id])) &&
  (!$model->inc->user->isDev() || $model->inc->user->isAdmin())
){
  if ( (empty($model->data[$admin]) && !empty($user['admin'])) ||
    (!empty($model->data[$admin]) && empty($user['admin']) && !$model->inc->user->isAdmin()) ||
    (($model->data[$dev]  !== $user['dev']) && !$model->inc->user->isAdmin())
  ){
    return $r;
  }
  /** @var int $i */
  $i = 0;
  if ( $user['id_group'] !== $model->data[$id_group] ){
    $i = $mgr->setUniqueGroup($model->data[$id], $model->data[$id_group]);
  }
  unset($model->data[$id_group]);
  if ( $mgr->edit($model->data) || $i ){
    $r['success'] = true;
    $r['data'] = $mgr->getUser($model->data[$id]);
  }
}
return $r;
