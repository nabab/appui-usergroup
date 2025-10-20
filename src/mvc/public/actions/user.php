<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var bbn\Mvc\Controller $ctrl */
if ($ctrl->hasArguments()) {
  $ctrl->setData(['action' => $ctrl->arguments[0]]);
}

$ctrl->action();
