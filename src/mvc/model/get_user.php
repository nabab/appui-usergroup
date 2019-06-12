<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var $model \bbn\mvc\model*/
if ( isset($model->data['id_user']) ){
  $manager = $model->inc->user->get_manager();
  return $manager->get_user($model->data['id_user']);
}
