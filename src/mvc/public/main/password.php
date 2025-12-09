<?php

/** @var bbn\Mvc\Controller $ctrl */
$ctrl->addData([
  'schema' => $ctrl->inc->user->getClassCfg()['arch']['passwords']
]);
$ctrl->combo(_('Password'), true);
