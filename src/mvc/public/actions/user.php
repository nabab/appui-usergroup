<?php

/** @var bbn\Mvc\Controller $ctrl */
if ($ctrl->hasArguments()) {
  $ctrl->setData(['action' => $ctrl->arguments[0]]);
}

$ctrl->action();
