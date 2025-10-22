<?php

if ($model->hasData(['start', 'end'], true)) {
  $d = $model->db->selectAll([
    'table' => 'bbn_members_sessions',
    'fields' => ['user_agent'],
    'where' => [[
      'field' => 'DATE(last_activity)',
      'operator' => '>=',
      'value' => $model->data['start']
    ], [
      'field' => 'DATE(last_activity)',
      'operator' => '<=',
      'value' => $model->data['end']
    ]]
  ]);
  $res = [
    'desktop' => [],
    'mobile' => [],
    'tablet' => []
  ];
  if (!empty($d)) {
    foreach ($d as $ua) {
      if ($b = get_browser($ua->user_agent)) {
        $device = [
          'type' => $b->device_type,
          'name' => $b->device_name,
          'brand' => $b->device_brand_name,
          'os' => $b->platform_description ?: $b->platform,
          'osVersion' => $b->platform_version,
          'osBits' => $b->platform_bits,
          'browser' => $b->browser,
          'browserVersion' => $b->version
        ];
        if ($b->istablet) {
          $res['tablet'][] = $device;
        }
        elseif ($b->ismobiledevice) {
          $res['mobile'][] = $device;
        }
        else {
          $res['desktop'][] = $device;
        }
      }
    }
  }

  return [
    'success' => true,
    'data' => $res
  ];
}

return ['success' => false];
