<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

/** @var $this \bbn\mvc\controller */
$this->combo("User Picker", [
  'groups' => $this->get_model(),
  'picker' => isset($this->post['picker']) ? $this->post['picker'] : false
]);