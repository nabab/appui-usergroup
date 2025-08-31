<?php
/** @var bbn\Mvc\Controller $ctrl */

$ctrl
    ->setIcon('nf nf-fa-user')
    ->setUrl(APPUI_USERGROUP_ROOT.'users')
    ->combo(_("User Management"), true);
