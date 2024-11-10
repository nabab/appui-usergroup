<?php
/**
 * What is my purpose?
 *
 **/

use bbn\X;
use bbn\Str;
use bbn\Cache;
use bbn\File\System;

/** @var bbn\Mvc\Model $model */


if ($model->hasData('launch')) {
  $cacheName = 'appuiUsergroupPermissionsCleaner';
  $cache = Cache::getCache();
  if (!($res = $cache->get($cacheName))) {
    $fs = new System();
    $root = $model->inc->options->fromCode('access', 'permissions');
    $res = [];
    $o =& $model->inc->options;
    $db =& $model->db;
    $fn = function($arr, $path = '') use (&$fn, &$res, &$o, &$db, &$fs) {
      foreach ($arr as $a) {
        $npath = $path . $a['code'];
        // Does it have children?
        $opts = $o->fullOptions($a['id']);
        if (!empty($opts)) {
          if (substr($npath, -1) !== '/') {
            $npath .= '/';
          }
  
          $fn($opts, $npath);
        }
        else {
          $exists = $fs->exists(BBN_APP_PATH . 'src/mvc/public/' . $npath . '.php');
          $num = $db->count('bbn_users_options', ['id_option' => $a['id']]);
          $count = count($fs->searchContents($npath, BBN_APP_PATH . 'src', true));
          if (!$num || !$exists || $count) {
            $res[] = [
              'publicPath' => $npath,
              'idPermission' => $a['id'],
              'numPermissions' => $num,
              'numReferences' => $count,
              'controllerExists' => $exists
            ];
          }
        }
      }
    };
    $success = false;
    $fn($o->fullOptions($root));
    $cache->set($cacheName, $res, 24*3600);
  }

  return [
    'res' => $res,
    'root' => $root,
    'success' => $success
  ];
}