<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var $model \bbn\mvc\model*/
if ( isset($model->data['id_user']) ){
  $manager = new \apst\manager($model->inc->user);
  return $manager->get_user($model->data['id_user']);
}
