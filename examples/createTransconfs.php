<?php
/**
 * Created by PhpStorm.
 * User: lejianwen
 * Date: 2016/12/27
 * Time: 15:33
 * QQ: 84855512
 */
include_once 'config.php';
$jediAuth = new \Jedi\JediAuth($ak, $sk);
$jediManager = new \Jedi\JediTransconfs($jediAuth);
$result = $jediManager->createTransconfs($hub, '自定义1');
print_r($result);