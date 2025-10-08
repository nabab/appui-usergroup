<?php

use bbn\X;
use bbn\Str;
/** @var $ctrl \bbn\Mvc\Controller */

if (empty($ctrl->post['limit'])) {
  $ctrl->combo(_("MVC logs"));
}
else {
  $ctrl->action();
}
