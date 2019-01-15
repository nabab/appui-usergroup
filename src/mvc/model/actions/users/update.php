<?php
/** @var \bbn\mvc\model $model */
$r = ['success' => false];

/** @var array $cfg */
$cfg = $model->inc->user->get_class_cfg();
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
  ($mgr = $model->inc->user->get_manager()) &&
  ($user = $mgr->get_user($model->data[$id])) &&
  (!$model->inc->user->is_dev() || $model->inc->user->is_admin())
){
  if ( (empty($model->data[$admin]) && !empty($user['admin'])) ||
    (!empty($model->data[$admin]) && empty($user['admin']) && !$model->inc->user->is_admin()) ||
    (($model->data[$dev]  !== $user['dev']) && !$model->inc->user->is_admin())
  ){
    return $r;
  }
  /** @var int $i */
  $i = 0;
  if ( $user['id_group'] !== $model->data[$id_group] ){
    $i = $mgr->set_unique_group($model->data[$id], $model->data[$id_group]);
  }
  unset($model->data[$id_group]);
  if ( $mgr->edit($model->data) || $i ){
    $r['success'] = true;
    $r['data'] = $mgr->get_user($model->data[$id]);
  }
}
return $r;
