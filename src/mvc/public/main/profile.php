<?php
$ctrl->combo(_("Mon profil"), [
  'data' => $ctrl->inc->user->get_session(),
  'root' => APPUI_USERGROUP_ROOT
]);