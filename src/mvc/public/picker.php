<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $ctrl \bbn\mvc\controller */
$ctrl->combo("User Picker", [
  'groups' => $ctrl->get_model(),
  'picker' => isset($ctrl->post['picker']) ? $ctrl->post['picker'] : false
]);