<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Home_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('server_model');
    }

    public function search() {
        if (isset($_POST['v'])) {
            $md5 = $_POST['v'];

            $server_list = $this->server_model->getList();
            $len         = count($server_list);
            $i           = mt_rand(0, $len - 1);
            $reqData     = $server_list[$i];

            $url = $reqData['addr'] . '/search?md5=' . $md5;

            $rData = file_get_contents($url);
            $rData = json_decode($rData, true);
            return $this->retOk("ok!", $rData['data']);
        }
        return $this->retFail("错误命令!");
    }

    public function postUrl($url, $post) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

}
