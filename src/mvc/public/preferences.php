<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

$cur = $ctrl->inc->pref->get_current();
$tbs = '79d4af90c0c511e78824366237393031';
/*
die(var_dump(
  $cur,
  //$ctrl->inc->options->option($cur),
  $ctrl->inc->pref->has($tbs),
  $ctrl->inc->pref->has($cur),
  $ctrl->inc->pref->get_group(),
  $ctrl->inc->pref->get_cfg($tbs),
  $ctrl->inc->pref->get($tbs)
));
/** @var $this \bbn\mvc\controller */
if ( isset($ctrl->post['limit']) ){
  $ctrl->obj = $ctrl->get_object_model('', $ctrl->post);
}
else if ( isset($ctrl->post['id']) ){
  $ctrl->obj->data = $ctrl->inc->pref->get_cfg($ctrl->post['id']);
}
else{
  $ctrl->data['options_root'] = $ctrl->plugin_url('appui-options').'/';
  $ctrl->combo(_('Mes préférences'), $ctrl->data);
}