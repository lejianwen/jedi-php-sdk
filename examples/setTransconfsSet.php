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
$transconfsset_id = '<transconfsset id>';
$is_able = 0; //0禁用  1启用
$jediAuth = new \Jedi\JediAuth($ak, $sk);
$jediManager = new \Jedi\JediTransconfs($jediAuth);
$result = $jediManager->setTransset($hub, $transconfs_id, $transconfsset_id, $is_able);
print_r($result);