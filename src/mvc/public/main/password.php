<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var bbn\Mvc\Controller $ctrl */
$ctrl->addData([
  'schema' => $ctrl->inc->user->getClassCfg()['arch']['passwords']
]);
$ctrl->combo(_('Password'), true);
