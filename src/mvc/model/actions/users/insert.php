<?php
/** @var \bbn\mvc\model $model */
$r = ['success' => false];
/** @var array $cfg */
$cfg = $model->inc->user->get_class_cfg();
$id_group = $cfg['arch']['users']['id_group'];
$email = $cfg['arch']['users']['email'];
$id = $cfg['arch']['users']['id'];
if ( isset($model->data[$id_group], $model->data[$email]) ){
  /** @var \bbn\user\manager $mgr */
  $mgr = $model->inc->user->get_manager();
  if ( $user = $mgr->add($model->data) ){
    $r['success'] = $mgr->set_unique_group($res[$id], $model->data[$id_group]);
    $user[$id_group] = $model->data[$id_group];
    $r['data'] = $user;
  }
}
return $r;