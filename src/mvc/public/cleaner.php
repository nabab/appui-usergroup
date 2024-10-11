<?php

use bbn\X;
use bbn\Str;
/** @var $ctrl \bbn\Mvc\Controller */

if (empty($ctrl->post['launch'])) {
  $ctrl->combo(_("Cleaning permissions"));
}
else {
  $ctrl->action();
}
