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
$jediAuth = new \Jedi\JediAuth($ak, $sk);
$jediManager = new \Jedi\JediTransconfs($jediAuth);
$result = $jediManager->deleteTransset($hub, $transconfs_id, $id);
print_r($result);