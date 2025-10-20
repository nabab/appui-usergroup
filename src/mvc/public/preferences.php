<?php
/*
 * Describe what it does to show you're not that dumb!
 *
 **/

$cur = $ctrl->inc->pref->getCurrent();
$tbs = '79d4af90c0c511e78824366237393031';
/*
die(var_dump(
  $cur,
  //$ctrl->inc->options->option($cur),
  $ctrl->inc->pref->has($tbs),
  $ctrl->inc->pref->has($cur),
  $ctrl->inc->pref->getIdGroup(),
  $ctrl->inc->pref->getCfg($tbs),
  $ctrl->inc->pref->get($tbs)
));
/** @var bbn\Mvc\Controller $ctrl */
if ( isset($ctrl->post['limit']) ){
  $ctrl->obj = $ctrl->getObjectModel('', $ctrl->post);
}
else if ( isset($ctrl->post['id']) ){
  $ctrl->obj->data = $ctrl->inc->pref->getCfg($ctrl->post['id']);
}
else{
  $ctrl->data['root'] = APPUI_USERGROUP_ROOT;
  $ctrl->data['options_root'] = $ctrl->pluginUrl('appui-option').'/';
  $ctrl->combo(_('My preferences'), $ctrl->data);
}