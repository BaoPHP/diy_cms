<?php
/**
 * Created by PhpStorm.
 * User: 77632
 * Date: 2017/12/8
 * Time: 11:09
 */

namespace tools;

use redis\Redis;

class Rand
{
    /**
     * 创建随机数
     * Power by Mikkle
     * QQ:776329498
     * @param int $num  随机数位数
     * @return string
     */
    static public function createRandNum($num=8){
        return substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, $num);
    }

    /*
* 通过创建随机数
*/
    static public function createSerialNumberByName($name){
        return self::createSerialNumberByRedis(__FUNCTION__.$name);
    }

    /*
     * 通过前缀创建随机数
     */
    static public function createSerialNumberByPrefix($prefix){
        return ((string)$prefix).self::createSerialNumberByRedis(__FUNCTION__.$prefix);
    }



    static public function createSerialNumberByRedis( $num=24){
        if ((int)$num<24){
            $num = 24;
        }
        return  ((string)self::getTimeInt()).substr(((string) (1*pow(10,($num-14) )+Redis::instance()->incre("createSerialNumber") )) ,1);
    }

    static public function createNumberString( $length=10 ){
        $len=1;
        $prefix="1";
        return (string) (1*pow(10,($length-$len)) +Redis::instance()->incre("createNumberString_{$prefix}") );
    }

    static public function createNumberStringByPrefix( $prefix  ,$length=12 ){
        $len=strlen($prefix);
        $str = (string) (1*pow(10,($length-$len)) +Redis::instance()->incre("createNumberString_{$prefix}") );
        return  $prefix . substr($str,1);
    }

    /*
* 获取Redis中使用的当天时间时间字符串
*/
    static public function getTimeString(){
        return date("Y-m-d H:i:s") ;
    }

    /*
* 获取Redis中使用的当天时间时间字符串
*/
    static public function getTimeInt(){
        return (int) date("YmdHis") ;
    }

    /*
     * 获取Redis中使用的当天时间时间字符串
     */
    static public function getDataString(){
        return date("Ymd_") ;
    }

    /*
 * 获取Redis中使用的当天时间时间字符串前缀
 */
    static public function getDataPrefix(){
        return date("Ymd_") ;
    }



}