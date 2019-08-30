<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $ctrl \bbn\mvc\controller */
$ctrl->add_data([
  'schema' => $ctrl->inc->user->get_class_cfg()['arch']['passwords']
]);
$ctrl->combo(null, true);
