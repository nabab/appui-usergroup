<?php
/** @var \bbn\mvc\model $model */
$r = ['success' => false];

/** @var array $cfg */
$cfg = $model->inc->user->get_class_cfg();
/** @var string $id_group */
$id_group = $cfg['arch']['users']['id_group'];
/** @var string $email */
$email = $cfg['arch']['users']['email'];
/** @var string $id */
$id = $cfg['arch']['users']['id'];

if ( isset($model->data[$id], $model->data[$id_group], $model->data[$email]) ){
  /** @var \bbn\user\manager $mgr */
  $mgr = $model->inc->user->get_manager();
  if ( $user = $mgr->get_user($model->data[$id]) ){
    /** @var int $i */
    $i = 0;
    if ( $user['id_group'] !== $model->data[$id_group] ){
      $i = $mgr->set_unique_group($model->data[$id], $model->data[$id_group]);
    }
    unset($model->data[$id_group]);
    if ( $mgr->edit($model->data) || $i ){
      $r['success'] = 1;
      $r['data'] = $mgr->get_user($model->data[$id]);
    }
  }
}
return $r;
