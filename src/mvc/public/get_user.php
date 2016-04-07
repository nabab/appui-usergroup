<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $this \bbn\mvc\controller */
if ( isset($this->post['id_user']) ){
  $this->obj->res = $this->get_model(['id_user' => $this->post['id_user']]);
}
