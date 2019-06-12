<?php
$ctrl->combo(_("My profile"), [
  'data' => $ctrl->inc->user->get_session(),
  'root' => APPUI_USERGROUP_ROOT,
  'schema' => $ctrl->inc->user->get_class_cfg()['arch']['users']
]);