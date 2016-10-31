<?php
if ( isset($ctrl->post['current_pass'], $ctrl->post['pass1'], $ctrl->post['pass2']) ){

}
else if ( isset($ctrl->post['email'], $ctrl->post['name']) && \bbn\str::is_email($ctrl->post['email']) ){

}
else{
  $ctrl->combo(_("Mon profil"), $ctrl->inc->user->get_session());
}
