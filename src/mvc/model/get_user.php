<?php
/*
 * Describe what it does or you're a pussy
 *
 **/

/** @var $this \bbn\mvc\model*/
if ( isset($this->data['id_user']) ){
  $manager = new \apst\manager($this->inc->user);
  return $manager->get_user($this->data['id_user']);
}
