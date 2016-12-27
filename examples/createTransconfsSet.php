<?php
/**
 * Created by PhpStorm.
 * User: lejianwen
 * Date: 2016/12/27
 * Time: 15:33
 * QQ: 84855512
 */
include_once 'config.php';
$transconfs_id = '<transconfs id>';
//详细配置请参考文档
$video_conf = [
    'name'    => 'TEST', //转码预设名称
    'enabled' => false,
    'format'  => 'mp4',
    'video'   => [
        'bit_rate'   => '1200k',
        'width'      => 480,
        'height'     => 852,
        'frame_rate' => '30'
    ],
    'audio'   => [
        'quality' => -1
    ]
];
$jediAuth = new \Jedi\JediAuth($ak, $sk);
$jediManager = new \Jedi\JediTransconfs($jediAuth);
$result = $jediManager->createTransset($hub, $transconfs_id, $video_conf);
print_r($result);