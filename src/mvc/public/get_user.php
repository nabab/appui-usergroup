<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $ctrl \bbn\mvc\controller */
if ( isset($ctrl->post['id_user']) ){
  $ctrl->obj->res = $ctrl->get_model(['id_user' => $ctrl->post['id_user']]);
}
