<?php
$ctrl->combo(_("Mon profil"), [
  'data' => $ctrl->inc->user->get_session(),
  'root' => $ctrl->data['root']
]);