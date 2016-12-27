<?php
/**
 * Created by PhpStorm.
 * User: lejianwen
 * Date: 2016/12/27
 * Time: 14:30
 * QQ: 84855512
 */
namespace Jedi;

use Qiniu\Http\Client;
use Qiniu\Http\Request;
use Qiniu\Storage\UploadManager;

final class JediTransconfs
{

    const JEDI_API_SERVER = 'http://jedi.qiniuapi.com';

    private $jediAuth;
    private $httpClient;

    public function __construct($jediAuth)
    {
        $this->jediAuth = $jediAuth;
        $this->httpClient = new Client();
    }

    protected function sendRequest($url, $type = 'GET', $body = [])
    {
        $postBodyBytes = json_encode($body);
        $postHeaders = array('Content-Type' => 'application/json');
        $request = new Request($type, $url, $postHeaders, $postBodyBytes);
        $authToken = $this->jediAuth->signRequest($request, 'application/json');
        $request->headers['Authorization'] = $authToken;
        return $this->httpClient->sendRequest($request);
    }

    /**创建转码配置
     * @param $hub string 空间名
     * @param $name string 转码配置名
     * @return \Qiniu\Http\Response
     */
    public function createTransconfs($hub, $name)
    {
        $postBody = array();
        if (!empty($hub))
        {
            $postBody['name'] = $name;
        }
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub . '/transconfs';
        $response = $this->sendRequest($postUrl, 'POST', $postBody);
        if ($response->ok())
            return ['result' => true, 'id' => $response->json()['id'], 'response' => $response];
        return ['result' => false, 'id' => '', 'response' => $response];
    }

    /**删除转码配置
     * @param $hub string 空间名
     * @param $id string 转码配置ID
     * @return array
     */
    public function deleteTransconfs($hub, $id)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $id;
        $response = $this->sendRequest($postUrl, 'DELETE');
        if ($response->ok())
            return ['result' => true, 'response' => $response];
        return ['result' => false, 'response' => $response];
    }

    /**获取所有转码配置
     * @param $hub string 空间名
     * @return array
     */
    public function getAllTransconfs($hub)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfsall';
        $response = $this->sendRequest($postUrl);
        if ($response->ok())
            return ['result' => $response->json(), 'response' => $response];
        return ['result' => false, 'response' => $response];
    }

    /**创建转码预设
     * @param $hub string 空间名
     * @param $transconfs_id string 转码配置ID
     * @param $video_conf array 配置数组
     * @return array
     */
    public function createTransset($hub, $transconfs_id, $video_conf)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $transconfs_id
            . '/transsets';
        $response = $this->sendRequest($postUrl, 'POST', $video_conf);
        if ($response->ok())
            return ['result' => true, 'id' => $response->json()['id'], 'response' => $response];
        return ['result' => false, 'id' => '', 'response' => $response];
    }

    /**跟新转码预设
     * @param $hub
     * @param $transconfs_id string 转码配置ID
     * @param $transset_id string 转码预设ID
     * @param $video_conf array 配置数组
     * @return array
     */
    public function updateTransset($hub, $transconfs_id, $transset_id, $video_conf)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $transconfs_id
            . '/transsets/' . $transset_id;
        $response = $this->sendRequest($postUrl, 'PUT', $video_conf);
        if ($response->ok())
            return ['result' => true, 'response' => $response];
        return ['result' => false, 'response' => $response];
    }

    /**启用禁用转码预设
     * @param $hub
     * @param $transconfs_id string 转码配置ID
     * @param $transset_id string 转码预设ID
     * @param int $is_able 0禁用  1启用
     * @return array
     */
    public function setTransset($hub, $transconfs_id, $transset_id, $is_able = 0)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $transconfs_id
            . '/transsets/' . $transset_id
            . '/enabled/' . $is_able;
        $response = $this->sendRequest($postUrl, 'PUT');
        if ($response->ok())
            return ['result' => true, 'response' => $response];
        return ['result' => false, 'response' => $response];
    }

    /**获取转码预设
     * @param $hub
     * @param $transconfs_id string 转码配置ID
     * @param $transset_id string 转码预设ID
     * @return array
     */
    public function getTransset($hub, $transconfs_id, $transset_id)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $transconfs_id
            . '/transsets/' . $transset_id;
        $response = $this->sendRequest($postUrl, 'GET');
        if ($response->ok())
            return ['result' => true, 'data' => $response->json(), 'response' => $response];
        return ['result' => false, 'data' => $response->json(), 'response' => $response];
    }

    /**删除转码预设
     * @param $hub
     * @param $transconfs_id string 转码配置ID
     * @param $transset_id string 转码预设ID
     * @return array
     */
    public function deleteTransset($hub, $transconfs_id, $transset_id)
    {
        $postUrl = self::JEDI_API_SERVER . '/v1/hubs/' . $hub
            . '/transconfs/' . $transconfs_id
            . '/transsets/' . $transset_id;
        $response = $this->sendRequest($postUrl, 'DELETE');
        if ($response->ok())
            return ['result' => true, 'response' => $response];
        return ['result' => false, 'response' => $response];
    }



}
