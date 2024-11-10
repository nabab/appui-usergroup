<?php

use bbn\X;
use bbn\Str;
/** @var bbn\Mvc\Controller $ctrl */

if (empty($ctrl->post['launch'])) {
  $ctrl->combo(_("Cleaning permissions"));
}
else {
  $ctrl->action();
}
