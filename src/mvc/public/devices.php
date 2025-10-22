<?php
if (!empty($ctrl->post['start']) && !empty($ctrl->post['end'])) {
  $ctrl->action();
}
else {
  $ctrl->combo(_("Devices"), true);
}