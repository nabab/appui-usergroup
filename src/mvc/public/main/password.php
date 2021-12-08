<?php

/** @var $ctrl \bbn\Mvc\Controller */
$ctrl->addData([
  'schema' => $ctrl->inc->user->getClassCfg()['arch']['passwords']
]);
$ctrl->combo(_('Password'), true);
