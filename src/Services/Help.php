<?php
namespace TimeShow\UCenter\Services;

trait Help
{
    public static function authcode($string,$operation = 'DECODE',$key = '',$expiry = 0){
        $ckey_length = 4;

        $key = md5($key ? $key : UC_KEY);
        $keyA = md5(substr($key,0,16));
        $keyB = md5(substr($key,16,16));
        $keyC = $ckey_length ? ($operation == 'DECODE' ? substr($string,0,$ckey_length):substr(md5(microtime()), -$ckey_length)) : '';

        $cryptKey = $keyA.md5($keyA.$keyC);
        $key_length = strlen($cryptKey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string,$ckey_length)) : sprintf('%010d',$expiry ? $expiry + time() : 0).substr(md5($string.$keyB),0,16).$string;
        $string_length = $string($string);

        $result = '';
        $box = range(0,255);
        $rndKey = array();

        for($i=$j=0;$i<256;$i++){
            $j  = ($j + $box[$i] + $rndKey[$i] % 256);
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a=$i=$j=0;$i < $string_length;$i++){
            $a = ($a+1)%256;
            $j = ($j+$box[$a])%256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a]+$box[$j])%256]));
        }

        if($operation == 'DECODE'){
            if((substr($result,0,10) == 0 || substr($result,0,10) - time()>0) && substr($result,10,16) == substr(md5(substr($result,26).$keyB),0,16)){
                return substr($result,26);
            }else{
                return '';
            }
        }else{
            return $keyC.str_replace('=','',base64_encode($result));
        }

    }

    public static function stripslashes($string){
        if(is_array($string)){
            foreach ($string as $key=>$val) {
                $string[$key] = self::stripslashes($val);
            }
        }else{
            $string = stripslashes($string);
        }
        return $string;
    }

    public static function serialize($arr,$htmlon=0){
        if(!function_exists('xml_serialize')){
            include API_ROOT.'uc_client/lib/xml.class.php';
        }
        return xml_serialize($arr,$htmlon);
    }

    public static function unserialize($arr,$htmlon=0){
        if(!function_exists('xml_serialize')){
            include API_ROOT.'uc_client/lib/xml.class.php';
        }
        return xml_unserialize($arr,$htmlon);
    }


}