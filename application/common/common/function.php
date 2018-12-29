<?php
use think\PHPMailer;
/**
 * 数字签名认证
 * @param string $data 被认证的数据
 * @return string 签名
 */
function dataAuthSign($data)
{
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名

    return $sign;
}

/**
 * 随机生成密码函数
 * @param int $length 密码长度
 * @return string
 */
function generate_password( $length = 8 ) {
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
    $password = '';
    for ( $i = 0; $i < $length; $i++ )
    {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $password;
}

/**
 * @param $data
 * @param $msg
 * @param $status
 * @return $info in json
 */
function ajaxReturn($data, $msg, $status=1){
    $info = array();
    $info['data'] = $data;
    $info['msg'] = $msg;
    $info['status'] = $status;
    if(sizeof($info)==0){
        header('Content-Type:text/html; charset=utf-8');
        exit(json_encode(array('error'=>"参数为空")));
    }else{
        header('Content-Type:text/html; charset=utf-8');
        exit(json_encode($info));
    }
}

function subtext($text, $length)
{
    if(mb_strlen($text, 'utf8') > $length){
        return mb_substr($text,0,$length,'utf8').'…';
    }else{
        return $text;
    }
}

/**
 * 删除文件
 * @param $file  待删除的文件路径
 */
function deleteFile($file){
    if(is_file($file)){
        return @unlink($file);
    }else{
        return false;
    }
}

/**
 * $house_id
 * @return string
 */
function makeOrderSn($house_id) {
    static $num;
    if (empty($num)) {
        $num = 1;
    } else {
        $num ++;
    }
    return (date('y',time()) % 9+1) . sprintf('%08d', $house_id) . sprintf('%02d', $num);
}