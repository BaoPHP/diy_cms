<?php
/**
 * Created by PhpStorm.
 * Power By Mikkle
 * Email：776329498@qq.com
 * Date: 2017/11/28
 * Time: 11:23
 */

namespace tools;


use master\Config;

/**
 *
 * ShowCode::jsonCode(1001)
 * Power: Mikkle
 * Email：776329498@qq.com
 * Class ShowCode
 * @package mikkle\tp_tools
 */
class ShowCode
{
    /**
     * 返回data值的Code码
     */
    static protected $successCode = [
        "1001",
    ];

    /**
     * 定义返回码的数组名称
     */
    static protected $returnCodeName=[
        "codeName"=>"code",
        "dataName"=>"data",
        "messageName"=>"msg",
    ];

    /**
     * 定义返回码的massage名称
     */
    static protected $returnCode=[
        '1001' => '操作成功',
        '1002' => '你想做什么呢', //非法的请求方式 非ajax
        '1003' => '请求参数错误', //如参数不完整,类型不正确
        '1004' => '请先登陆再访问', //未登录 或者 未授权
        '1005' => '请求授权不符', ////非法的请求  无授权查看
        '1006' => '数据加载失败', //
        '1007' => '数据修改失败', //
        '1008' => '系统错误', //
        '1010' => '数据不存在', //
        '1020' => '验证码输入不正确', //
        '1021' => '用户账号或密码错误', //
        '1022' => '用户账号被禁用', //
        '1030' => '数据操作失败', //
    ];

    /**
     * 默认的返回码
     */
    static protected $defaultCode = [
        'code' => '1099',
        'msg' => '未知服务器消息',
        'data' => [],
    ];


    /**
     * 返回码主方法
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $code 返回码
     * @param array $data 返回值
     * @param string $msg 返回消息的说明
     * @param array $append 附加信息
     * @return array
     */
    static public function code($code = '', $data = [], $msg = '' , array $append=[]){
        $returnCode = self::$defaultCode;
        if (empty($code)) {
            return $returnCode;
        }else{
            $returnCode["code"] = $code;
        }
        if (in_array($code,self::$successCode) || isset(self::$successCode[$code])){
            $returnCode["data"] = $data;
        }
        if(!empty($msg)){
            $returnCode['msg'] = $msg;
        }else if (isset(self::$returnCode[$code]) ) {
            $returnCode['msg'] = self::$returnCode[$code];
        }
        $return = [
            self::$returnCodeName["codeName"] => $returnCode["code"],
            self::$returnCodeName["dataName"] => $returnCode["data"],
            self::$returnCodeName["messageName"] => $returnCode["msg"],
        ];
        if (!empty($append)&& is_array($append)){
            $return=array_merge($return,$append);
        }
        return $return;

    }

    /**
     * 别名方法 无data返回值
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $code
     * @param string $msg
     * @param array $append
     * @return array
     */
    static public function codeWithoutData($code = '', $msg = '',array $append=[]){
        return self::code($code,[],$msg,$append);
    }
    /**
     * 别名方法 返回json格式返回码
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $code
     * @param string $msg
     * @param array $append
     * @return array
     */
    static public function jsonCode($code = '', $data = [], $msg = '', array $append=[]){
        self::returnJsonType();
        return self::code($code,$data,$msg,$append);
    }
    /**
     * 别名方法 返回json格式返回码 无data值
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $code
     * @param string $msg
     * @param array $append
     * @return array
     */
    static public function jsonCodeWithoutData($code = '', $msg = '' ,array $append=[]){
        self::returnJsonType();
        return self::code($code,[],$msg,$append);
    }

    static public function returnJsonType(){
        Config::set("default_return_type","json");
    }

}