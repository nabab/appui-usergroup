<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $ctrl \bbn\Mvc\Controller */
$ctrl->addData([
  'schema' => $ctrl->inc->user->getClassCfg()['arch']['passwords']
]);
$ctrl->combo(_('Password'), true);
