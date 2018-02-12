<?php
/** @var \bbn\mvc\model $model */
$r = ['success' => false];
/** @var array $cfg */
$cfg = $model->inc->user->get_class_cfg();
$id_group = $cfg['arch']['users']['id_group'];
$email = $cfg['arch']['users']['email'];
$id = $cfg['arch']['users']['id'];
/** @var string $admin */
$admin = $cfg['arch']['users']['admin'];
$dev = $cfg['arch']['users']['dev'];
if ( isset($model->data[$id_group], $model->data[$email], $model->data[$admin], $model->data[$dev]) &&
  (!$model->inc->user->is_dev() || $model->inc->user->is_admin()) &&
  ((empty($model->data[$admin]) && empty($model->data[$dev])) || $model->inc->user->is_admin())
){
  /** @var \bbn\user\manager $mgr */
  $mgr = $model->inc->user->get_manager();
  if ( $user = $mgr->add($model->data) ){
    $r['success'] = $mgr->set_unique_group($model->data[$id], $model->data[$id_group]);
    $user[$id_group] = $model->data[$id_group];
    $r['data'] = $user;
  }
}
return $r;