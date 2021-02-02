<?php
$ctrl->combo(_("My profile"), [
  'data' => $ctrl->inc->user->getSession(),
  'root' => APPUI_USERGROUP_ROOT,
  'schema' => $ctrl->inc->user->getClassCfg()['arch']['users']
]);