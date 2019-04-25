<?php

namespace common\components;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\web\UploadedFile;

/**
 * 系统助手类
 *
 * @author        Atuxe Young [atuxe@atuxe.com]
 * @copyright     Copyright (c) 2006-2015 JCYCMS Inc. All rights reserved.
 * @link
 * @package       JCYCMS.Tools
 * @license
 * @version       1.0.0
 */
class Utils {

    public static function mult_unique($array)
    {
      $return = [];
      foreach ($array as $key => $v) {
        if (!in_array($v, $return)) {
            $return[] = $v;
        }
      }

      return $return;
    }

    public static function checkEncoding($string, $string_encoding)
    {
        $fs = $string_encoding == 'UTF-8' ? 'UTF-32' : $string_encoding;
        $ts = $string_encoding == 'UTF-32' ? 'UTF-8' : $string_encoding;

        return $string === mb_convert_encoding ( mb_convert_encoding ( $string, $fs, $ts ), $ts, $fs );
    }

    /*
     * 精确时间间隔函数
     * $time 发布时间 如 1356973323
     * $str 输出格式 如 Y-m-d H:i:s
     * 半年的秒数为15552000，1年为31104000，此处用半年的时间
     */
    public static function datetimeToText($datetime, $str=''){
        $time = strtotime($datetime);
        !empty($str) ? $str : $str = 'Y-m-d';
        $way = time() - $time;
        $r = '';
        if($way < 60){
            $r = '刚刚';
        }elseif($way >= 60 && $way <3600){
            $r = floor($way/60).'分钟前';
        }elseif($way >=3600 && $way <86400){
            $r = floor($way/3600).'小时前';
        }elseif($way >=86400 && $way <2592000){
            $r = floor($way/86400).'天前';
        }elseif($way >=2592000 && $way <15552000){
            $r = floor($way/2592000).'个月前';
        }else{
            $r = date("$str",$time);
        }
        return $r;
    }

    public static function isTimestamp($timestamp) {
        if (strtotime(date('Y-m-d H:i:s', $timestamp)) === (int)$timestamp) {
            return $timestamp;
        }

        return false;
    }

    public static function tranDateTime($datetime)
    {
        $time = self::isTimestamp($datetime) ? $datetime : strtotime($datetime);
        $rtime = date("m-d H:i", $time);
        $htime = date("H:i",$time);

        $time = time() - $time;

        if ($time < 60)
        {
            $str = '刚刚';
        }
        elseif ($time < 60 * 60)
        {
            $min = floor($time/60);
            $str = $min.'分钟前';
        }
        elseif ($time < 60 * 60 * 24)
        {
            $h = floor($time/(60*60));
            $str = $h.'小时前 '.$htime;
        }
        elseif ($time < 60 * 60 * 24 * 3)
        {
            $d = floor($time/(60*60*24));
            if($d==1)
                $str = '昨天 '.$rtime;
            else
                $str = '前天 '.$rtime;
        }
        else
        {
            $str = $rtime;
        }
        return $str;
    }

    /**
     * 资源文件的根地址
     * @param  string $type 类型 [qiniu|local]
     * @return string       base url
     */
    public static function baseUrl($type='local')
    {
        $localUrl = Yii::$app->request->hostInfo . Yii::$app->request->baseUrl;
        $arr = array(
            'qiniu' => YII_DEBUG ? $localUrl : @Yii::$app->params['qiniu']['baseUrl'],
            'local' => $localUrl,
            'uploads' => isset(Yii::$app->params['uploadsUrl']) ? Yii::$app->params['uploadsUrl'] : $localUrl,
        );
        return $arr[$type];
    }

    /**
     * 转换图片URL
     * @param  string $path 图片地址
     * @return string
     */
    public static function photoUrl($path='')
    {
        if (empty($path)) {
            return self::baseUrl() . '/static/img/noimg.jpg';
        }
        // 绝对地址
        if (self::url($path)) {
            return $path;
        }
        // 本系统
        elseif (strpos($path, 'uploads/') !== false) {
            return self::baseUrl('uploads') . '/' . $path;
        }
        return $path;
    }

    /**
     * 判断设备类型
     * @param  string $value 设备特征 [iPod|iPhone|iPad|Android|webOS|Windows|Mac]
     * @return bool
     */
    public static function deviceIs($value='')
    {
        if ($value == 'IOS') {
            $value = array('iPod', 'iPhone', 'iPad');
        } elseif ($value == 'Mobile') {
            $value = array('iPod', 'iPhone', 'iPad', 'Android');
        } elseif (in_array($value, array('wechat', 'weixin'))) {
            $value = 'micromessenger';
        } elseif (in_array($value, array('boyuntong', '博韵通'))) {
            $value = 'boyuntong';
        }

        if (is_array($value)) {
            foreach ($value as $v) {
                if (stripos($_SERVER['HTTP_USER_AGENT'], $v)) {
                    return true;
                }
            }
            return false;
        } else {
            return stripos($_SERVER['HTTP_USER_AGENT'], $value);
        }
    }

    /**
     * 操作完成后输出的内容
     * @param  integer $status 200:ok; 300:error; 301:timeout
     * @param  array   $json       {status  int; message    string; tabid   string; dialogid    string; divid   string; closeCurrent    boolea; forward string; forwardConfirm  string}
     * @return [type]              [description]
     */
    public static function callback($json=array(), $status='ok')
    {
        $config = array(
            'ok'=>array(10002, '操作成功'),
            'error'=>array(10001, '操作失败'),
            'timeout'=>array(10003, '操作超时'),
        );
        $json['code'] = $config[$status][0];

        if (!isset($json['message'])) {
            $json['message'] = $config[$status][1];
        }

        echo JSON::encode($json);
        Yii::$app->end();
    }

    public static function statusOption()
    {
        return array('激活'=>'激活', '锁定'=>'锁定',);
    }



    /**
     * 右侧补0
     * @param  [type]  $str   [description]
     * @param  integer $count [description]
     * @return [type]         [description]
     */
    public static function zerofill($str, $count=8)
    {
        if (strlen($str) < $count) {
            $str = $str.self::getZero($count-strlen($str));
        }
        return $str;
    }

    /**
     * 获取count个0字符串
     * @param  integer $count [description]
     * @return [type]         [description]
     */
    public static function getZero($count=0)
    {
        $zero = '';
        for ($i=0; $i < $count; $i++) {
            $zero .= '0';
        }
        return $zero;
    }

    /**
     * 取文件扩展名
     * @param  string $name [description]
     * @return [type]       [description]
     */
    public static function getExt($name='')
    {
        $arr = explode('.', $name);
        return $arr[count($arr)-1];
    }

    /**
     * 生成GUID
     * @return [type] [description]
     */
    function guid()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = chr(123)// "{"
                    . substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12)
                    . chr(125); // "}"
            return $uuid;
        }
    }

    /**
     * 友好显示var_dump
     */
    static public function dump( $var, $echo = true, $label = null, $strict = true )
    {
        $label = ( $label === null ) ? '' : rtrim( $label ) . ' ';
        if ( ! $strict ) {
            if ( ini_get( 'html_errors' ) ) {
                $output = print_r( $var, true );
                $output = "<pre>" . $label . htmlspecialchars( $output, ENT_QUOTES ) . "</pre>";
            } else {
                $output = $label . print_r( $var, true );
            }
        } else {
            ob_start();
            var_dump( $var );
            $output = ob_get_clean();
            if ( ! extension_loaded( 'xdebug' ) ) {
                $output = preg_replace( "/\]\=\>\n(\s+)/m", "] => ", $output );
                $output = '<pre>' . $label . htmlspecialchars( $output, ENT_QUOTES ) . '</pre>';
            }
        }
        if ( $echo ) {
            echo $output;
            return null;
        } else
            return $output;
    }

    /**
     * 获取客户端IP地址
     */
    static public function getClientIP()
    {
        // static $ip = NULL;
        // if ( $ip !== NULL )
        //     return $ip;
        // if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        //     $arr = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] );
        //     $pos = array_search( 'unknown', $arr );
        //     if ( false !== $pos )
        //         unset( $arr[$pos] );
        //     $ip = trim( $arr[0] );
        // } elseif ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
        //     $ip = $_SERVER['HTTP_CLIENT_IP'];
        // } elseif ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
        //     $ip = $_SERVER['REMOTE_ADDR'];
        // }
        // // IP地址合法验证
        // $ip = ( false !== ip2long( $ip ) ) ? $ip : '0.0.0.0';
        // return $ip;

        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            } elseif (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }

        return $realip;
    }

    /**
     * 循环创建目录
     */
    static public function mkdir( $dir, $mode = 0777 )
    {
        if ( is_dir( $dir ) || @mkdir( $dir, $mode ) )
            return true;
        if ( ! mk_dir( dirname( $dir ), $mode ) )
            return false;
        return @mkdir( $dir, $mode );
    }

    /**
     * 格式化单位
     */
    static public function byteFormat( $size, $dec = 2 )
    {
        $a = array ( "B" , "KB" , "MB" , "GB" , "TB" , "PB" );
        $pos = 0;
        while ( $size >= 1024 ) {
            $size /= 1024;
            $pos ++;
        }
        return round( $size, $dec ) . " " . $a[$pos];
    }

    /**
     * 下拉框，单选按钮 自动选择
     *
     * @param $string 输入字符
     * @param $param  条件
     * @param $type   类型
     *            selected checked
     * @return string
     */
    static public function selected( $string, $param = 1, $type = 'select' )
    {

        $true = null;
        $return = null;
        if ( is_array( $param ) ) {
            $true = in_array( $string, $param );
        }elseif ( $string == $param ) {
            $true = true;
        }
        if ( $true )
            $return = $type == 'select' ? 'selected="selected"' : 'checked="checked"';

        echo $return;
    }

    /**
     * 获得来源类型 post get
     *
     * @return unknown
     */
    static public function method()
    {
        return strtoupper( isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : 'GET' );
    }

    /**
     * 查询字符生成
     */
    static public function buildCondition( array $getArray, array $keys = array() )
    {
        $arr = array();
        if ( $getArray ) {
            foreach ( $getArray as $key => $value ) {
                if ( in_array( $key, $keys ) && $value ) {
                    $arr[$key] = Html::encode(strip_tags($value));
                }
            }
            return $arr;
        }
    }

    /**
     * base64_encode
     */
    static function b64encode( $string )
    {
        $data = base64_encode( $string );
        $data = str_replace( array ( '+' , '/' , '=' ), array ( '-' , '_' , '' ), $data );
        return $data;
    }

    /**
     * base64_decode
     */
    static function b64decode( $string )
    {
        $data = str_replace( array ( '-' , '_' ), array ( '+' , '/' ), $string );
        $mod4 = strlen( $data ) % 4;
        if ( $mod4 ) {
            $data .= substr( '====', $mod4 );
        }
        return base64_decode( $data );
    }

    /**
     * 验证是否含有中文
     */
    public static function chinese($string)
    {
        if (empty($string)) {
            return false;
        }

        $chars = "/[\x{4e00}-\x{9fa5}]/u";
        if (preg_match($chars, $string) !== false) {
            return true;
        }

        return false;
    }

    /**
     * 验证邮箱
     */
    public static function email( $str )
    {
        if ( empty( $str ) )
            return true;
        $chars = "/^([a-z0-9+_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,6}\$/i";
        if ( strpos( $str, '@' ) !== false && strpos( $str, '.' ) !== false ) {
            if ( preg_match( $chars, $str ) ) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 验证手机号码
     */
    public static function mobile( $str )
    {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '#^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$#', $str );
    }

    /**
     * 验证固定电话
     */
    public static function tel( $str )
    {
        if ( empty( $str ) ) {
            return true;
        }
        return preg_match( '/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', trim( $str ) );

    }

    /**
     * 验证qq号码
     */
    public static function qq( $str )
    {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '/^[1-9]\d{4,12}$/', trim( $str ) );
    }

    /**
     * 验证邮政编码
     */
    public static function zipCode( $str )
    {
        if ( empty( $str ) ) {
            return true;
        }

        return preg_match( '/^[1-9]\d{5}$/', trim( $str ) );
    }

    /**
     * 验证ip
     */
    public static function ip( $str )
    {
        if ( empty( $str ) )
            return true;

        if ( ! preg_match( '#^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$#', $str ) ) {
            return false;
        }

        $ip_array = explode( '.', $str );

        //真实的ip地址每个数字不能大于255（0-255）
        return ( $ip_array[0] <= 255 && $ip_array[1] <= 255 && $ip_array[2] <= 255 && $ip_array[3] <= 255 ) ? true : false;
    }

    /**
     * 验证身份证(中国)
     */
    public static function idCard( $str )
    {
        $str = trim( $str );
        if ( empty( $str ) )
            return true;

        if ( preg_match( "/^([0-9]{15}|[0-9]{17}[0-9a-z])$/i", $str ) )
            return true;
        else
            return false;
    }

    /**
     * 验证网址
     */
    public static function url( $str )
    {
        if ( empty( $str ) )
            return true;

        return preg_match( '#(http|https|ftp|ftps)://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?#i', $str ) ? true : false;
    }

    /**
     * 根据ip获取地理位置
     * @param $ip
     * return :ip,beginip,endip,country,area
     */
    public static function getlocation( $ip = '' )
    {
        $ip = new XIp();
        $ipArr = $ip->getlocation( $ip );
        return $ipArr;
    }

    /**
     * 中文转换为拼音
     */
    public static function pinyin($_String, $_Code='gb2312')
    {
        $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha".
        "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|".
        "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er".
        "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui".
        "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang".
        "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang".
        "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue".
        "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne".
        "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen".
        "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang".
        "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|".
        "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|".
        "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu".
        "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you".
        "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|".
        "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
        $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990".
        "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725".
        "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263".
        "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003".
        "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697".
        "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211".
        "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922".
        "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468".
        "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664".
        "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407".
        "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959".
        "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652".
        "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369".
        "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128".
        "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914".
        "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645".
        "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149".
        "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087".
        "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658".
        "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340".
        "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888".
        "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585".
        "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847".
        "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055".
        "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780".
        "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274".
        "|-10270|-10262|-10260|-10256|-10254";
        $_TDataKey = explode('|', $_DataKey);
        $_TDataValue = explode('|', $_DataValue);
        $_Data = (PHP_VERSION>='5.0') ? array_combine($_TDataKey, $_TDataValue) :Arr_Combine($_TDataKey, $_TDataValue);
        arsort($_Data);
        reset($_Data);
        if($_Code != 'gb2312') $_String = self::U2_Utf8_Gb($_String);
        $_Res = '';
        for($i=0; $i<strlen($_String); $i++){
            $_P = ord(substr($_String, $i, 1));
            if($_P>160) { $_Q = ord(substr($_String, ++$i, 1)); $_P = $_P*256 + $_Q - 65536; }
            $_Res .= self::Pinyins($_P, $_Data);
        }
        return $_Res;
    }

    public static function Pinyins($_Num, $_Data)
    {
        if ($_Num>0 && $_Num<160 ) {
             return chr($_Num);
        }elseif($_Num<-20319 || $_Num>-10247) return '';
        else {
            foreach($_Data as $k=>$v){ if($v<=$_Num) break; }
            return $k;
        }
    }

    public static function U2_Utf8_Gb($_C)
    {
        $_String = '';
        if($_C < 0x80){
            $_String .= $_C;
        }elseif($_C < 0x800){
            $_String .= chr(0xC0 | $_C>>6);
            $_String .= chr(0x80 | $_C & 0x3F);
        }elseif($_C < 0x10000){
            $_String .= chr(0xE0 | $_C>>12);
            $_String .= chr(0x80 | $_C>>6 & 0x3F);
            $_String .= chr(0x80 | $_C & 0x3F);
        }elseif($_C < 0x200000) {
            $_String .= chr(0xF0 | $_C>>18);
            $_String .= chr(0x80 | $_C>>12 & 0x3F);
            $_String .= chr(0x80 | $_C>>6 & 0x3F);
            $_String .= chr(0x80 | $_C & 0x3F);
        }

        return @iconv('UTF-8', 'GB2312', $_String);
    }

    /**
     * 拆分sql
     *
     * @param $sql
     */
    public static function splitsql( $sql ) {
         $sql = preg_replace("/TYPE=(InnoDB|MyISAM|MEMORY)( DEFAULT CHARSET=[^; ]+)?/", "ENGINE=\\1 DEFAULT CHARSET=" . Yii::$app->db->charset, $sql);
        $sql = str_replace("\r", "\n", $sql);
        $ret = array ();
        $num = 0;
        $queriesarray = explode(";\n", trim($sql));
        unset($sql);
        foreach ($queriesarray as $query) {
            $ret[$num] = '';
            $queries = explode("\n", trim($query));
            $queries = array_filter($queries);
            foreach ($queries as $query) {
                $str1 = substr($query, 0, 1);
                if ($str1 != '#' && $str1 != '-')
                    $ret[$num] .= $query;
            }
            $num ++;
        }
        return ($ret);
    }

    /**
     * 字符截取
     *
     * @param $string
     * @param $length
     * @param $dot
     */
    public static function cutstr( $string, $length, $dot = '...', $charset = 'utf-8' )
    {
        if ( strlen( $string ) <= $length )
            return $string;

        $pre = chr( 1 );
        $end = chr( 1 );
        $string = str_replace( array( '&amp;' , '&quot;' , '&lt;' , '&gt;' ), array( $pre . '&' . $end , $pre . '"' . $end , $pre . '<' . $end , $pre . '>' . $end ), $string );
        $string = str_replace("&nbsp;", '', $string);
        $strcut = '';
        if ( strtolower( $charset ) == 'utf-8' ) {

            $n = $tn = $noc = 0;
            while ( $n < strlen( $string ) ) {

                $t = ord( $string[$n] );
                if ( $t == 9 || $t == 10 || ( 32 <= $t && $t <= 126 ) ) {
                    $tn = 1;
                    $n ++;
                    $noc ++;
                } elseif ( 194 <= $t && $t <= 223 ) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif ( 224 <= $t && $t <= 239 ) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif ( 240 <= $t && $t <= 247 ) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif ( 248 <= $t && $t <= 251 ) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ( $t == 252 || $t == 253 ) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n ++;
                }

                if ( $noc >= $length ) {
                    break;
                }

            }
            if ( $noc > $length ) {
                $n -= $tn;
            }

            $strcut = substr( $string, 0, $n );

        } else {
            for ( $i = 0; $i < $length; $i ++ ) {
                $strcut .= ord( $string[$i] ) > 127 ? $string[$i] . $string[++ $i] : $string[$i];
            }
        }

        $strcut = str_replace( array ( $pre . '&' . $end , $pre . '"' . $end , $pre . '<' . $end , $pre . '>' . $end ), array ( '&amp;' , '&quot;' , '&lt;' , '&gt;' ), $strcut );

        $pos = strrpos( $strcut, chr( 1 ) );
        if ( $pos !== false ) {
            $strcut = substr( $strcut, 0, $pos );
        }
        return $strcut . $dot;
    }

    /**
     * 描述格式化
     * @param  $subject
     */
    public static function clearCutstr ($subject, $length = 0, $dot = '...', $charset = 'utf-8')
    {
        if ($length) {
            return Utils::cutstr(strip_tags(str_replace(array ("\r\n" ), '', $subject)), $length, $dot, $charset);
        } else {
            return strip_tags(str_replace(array ("\r\n" ), '', $subject));
        }
    }

    /**
     * 检测是否为英文或英文数字的组合
     *
     * @return unknown
     */
    public static function isEnglist( $param )
    {
        if ( ! eregi( "^[A-Z0-9]{1,26}$", $param ) ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 将自动判断网址是否加http://
     *
     * @param $http
     * @return  string
     */
    public static function convertHttp( $url )
    {
        if ( $url == 'http://' || $url == '' )
            return '';

        if ( substr( $url, 0, 7 ) != 'http://' && substr( $url, 0, 8 ) != 'https://' )
            $str = 'http://' . $url;
        else
            $str = $url;
        return $str;

    }

    /*
        标题样式格式化
    */
    public static function titleStyle( $style )
    {
        $text = '';
        if ( $style['bold'] == 'Y' ) {
            $text .='font-weight:bold;';
            $serialize['bold'] = 'Y';
        }

        if ( $style['underline'] == 'Y' ) {
            $text .='text-decoration:underline;';
            $serialize['underline'] = 'Y';
        }

        if ( !empty( $style['color'] ) ) {
            $text .='color:#'.$style['color'].';';
            $serialize['color'] = $style['color'];
        }

        return array( 'text' => $text, 'serialize'=>empty( $serialize )? '': serialize( $serialize ) );

    }

     // 自动转换字符集 支持数组转换
    static public function autoCharset ($string, $from = 'gbk', $to = 'utf-8')
    {
        $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
        $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
        if (strtoupper($from) === strtoupper($to) || empty($string) || (is_scalar($string) && ! is_string($string))) {
            //如果编码相同或者非字符串标量则不转换
            return $string;
        }
        if (is_string($string)) {
            if (function_exists('mb_convert_encoding')) {
                return mb_convert_encoding($string, $to, $from);
            } elseif (function_exists('iconv')) {
                return iconv($from, $to, $string);
            } else {
                return $string;
            }
        } elseif (is_array($string)) {
            foreach ($string as $key => $val) {
                $_key = self::autoCharset($key, $from, $to);
                $string[$_key] = self::autoCharset($val, $from, $to);
                if ($key != $_key)
                    unset($string[$key]);
            }
            return $string;
        } else {
            return $string;
        }
    }

    /*
        标题样式恢复
    */
    public static function titleStyleRestore( $serialize, $scope = 'bold' )
    {
        $unserialize = unserialize( $serialize );
        if ( $unserialize['bold'] =='Y' && $scope == 'bold' )
            return 'Y';
        if ( $unserialize['underline'] =='Y' && $scope == 'underline' )
            return 'Y';
        if ( $unserialize['color'] && $scope == 'color' )
            return $unserialize['color'];

    }

    /**
     * 列出文件夹列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getDir( $dirname )
    {
        $files = array();
        if ( is_dir( $dirname ) ) {
            $fileHander = opendir( $dirname );
            while ( ( $file = readdir( $fileHander ) ) !== false ) {
                $filepath = $dirname . '/' . $file;
                if ( strcmp( $file, '.' ) == 0 || strcmp( $file, '..' ) == 0 || is_file( $filepath ) ) {
                    continue;
                }
                $files[] =  self::autoCharset( $file, 'GBK', 'UTF8' );
            }
            closedir( $fileHander );
        }
        else {
            $files = false;
        }
        return $files;
    }

    /**
     * 列出文件列表
     *
     * @param $dirname
     * @return unknown
     */
    public static function getFile( $dirname )
    {
        $files = array();
        if ( is_dir( $dirname ) ) {
            $fileHander = opendir( $dirname );
            while ( ( $file = readdir( $fileHander ) ) !== false ) {
                $filepath = $dirname . '/' . $file;

                if ( strcmp( $file, '.' ) == 0 || strcmp( $file, '..' ) == 0 || is_dir( $filepath ) ) {
                    continue;
                }
                $files[] = self::autoCharset( $file, 'GBK', 'UTF8' );;
            }
            closedir( $fileHander );
        }
        else {
            $files = false;
        }
        return $files;
    }


    /**
     * [格式化图片列表数据]
     *
     * @return [type] [description]
     */
    public static function imageListSerialize( $data )
    {
        $var = array();
        foreach ( (array)$data['file'] as $key => $row ) {
            if ( $row ) {
                $var[$key]['fileId'] = $data['fileId'][$key];
                $var[$key]['file'] = $row;
            }

        }
        return array( 'data'=>$var, 'dataSerialize'=>empty( $var )? '': serialize( $var ) );

    }

    /**
     * 反引用一个引用字符串
     * @param  $string
     * @return string
     */
    static function stripslashes($string)
    {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = self::stripslashes($val);
            }
        } else {
            $string = stripslashes($string);
        }
        return $string;
    }

    /**
     * 引用字符串
     * @param  $string
     * @param  $force
     * @return string
     */
   static function addslashes($string, $force = 1)
   {
        if(is_array($string)) {
            foreach($string as $key => $val) {
                $string[$key] = self::addslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        return $string;
    }

    /**
     * 格式化内容
     */
    static function formatHtml($content, $options = '')
    {
        $purifier = new HtmlPurifier();
        if($options != false)
            $purifier->options = $options;
        return $purifier->purify($content);
    }
    /**
     * 获取字符串首字母
     */
    public static function getFirstLetter($str)
    {

        $fchar = ord($str{0});

        if ($fchar >= ord("A") and $fchar <= ord("z"))

            return strtoupper($str{0});

        $s1 = mb_convert_encoding($str, "UTF-8", "gb2312");
        $s2 = mb_convert_encoding($s1, "UTF-8", "gb2312");

        if ($s2 == $str) {

            $s = $s1;

        } else {

            $s = $str;

        }

        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;

        if ($asc >= -20319 and $asc <= -20284)

            return "A";

        if ($asc >= -20283 and $asc <= -19776)

            return "B";

        if ($asc >= -19775 and $asc <= -19219)

            return "C";

        if ($asc >= -19218 and $asc <= -18711)

            return "D";

        if ($asc >= -18710 and $asc <= -18527)

            return "E";

        if ($asc >= -18526 and $asc <= -18240)

            return "F";

        if ($asc >= -18239 and $asc <= -17923)

            return "G";

        if ($asc >= -17922 and $asc <= -17418)

            return "H";

        if ($asc >= -17417 and $asc <= -16475)

            return "J";

        if ($asc >= -16474 and $asc <= -16213)

            return "K";

        if ($asc >= -16212 and $asc <= -15641)

            return "L";

        if ($asc >= -15640 and $asc <= -15166)

            return "M";

        if ($asc >= -15165 and $asc <= -14923)

            return "N";

        if ($asc >= -14922 and $asc <= -14915)

            return "O";

        if ($asc >= -14914 and $asc <= -14631)

            return "P";

        if ($asc >= -14630 and $asc <= -14150)

            return "Q";

        if ($asc >= -14149 and $asc <= -14091)

            return "R";

        if ($asc >= -14090 and $asc <= -13319)

            return "S";

        if ($asc >= -13318 and $asc <= -12839)

            return "T";

        if ($asc >= -12838 and $asc <= -12557)

            return "W";

        if ($asc >= -12556 and $asc <= -11848)

            return "X";

        if ($asc >= -11847 and $asc <= -11056)

            return "Y";

        if ($asc >= -11055 and $asc <= -10247)

            return "Z";

        return null;

    }

    public static function shortSpell($zh)
    {

        $ret = "";

        $s1 = iconv("UTF-8", "gb2312", $zh);

        $s2 = iconv("gb2312", "UTF-8", $s1);

        if ($s2 == $zh) {

            $zh = $s1;

        }

        for ($i = 0; $i < strlen($zh); $i++) {

            $s1 = substr($zh, $i, 1);

            $p = ord($s1);

            if ($p > 160) {

                $s2 = substr($zh, $i++, 2);

                $ret .= self::getFirstLetter($s2);

            } else {

                $ret .= $s1;

            }

        }

        return $ret;

    }

    /**
     * ExportExcel
     * @param  array $header   表头
     * @param  array $data     数据
     * @param  string $title    表格标题
     * @param  string $filename Excel文件名
     * @return Downloading Excel
     */
    public static function exportExcel($header, $data, $title, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $datas = ArrayHelper::merge([$header], $data);
        $spreadsheet->getActiveSheet()->fromArray($datas, NULL, 'A1');

        $writer = new Xlsx($spreadsheet);
        $writer->save($filename . '.xlsx');
    }

    public static function downloadFile($filePath = '', $title = '')
    {
        if (empty($filePath)) {
            return false;
        }

        $fileName = basename($filePath);
        if (!empty($title)) {
            $ext = UploadedFile::getExtension($filePath);
            $fileName = $title . '.' . $ext;
            $contentDispositionField = 'Content-Disposition: attachment; '
                . sprintf('filename="%s"; ', rawurlencode($fileName))
                . sprintf("filename*=utf-8''%s", rawurlencode($fileName));
        } else {
            $contentDispositionField = sprintf('Content-Disposition: attachment; filename="%s"', $fileName);
        }

        $mime = 'application/force-download';
        // $mime = CFileHelper::getMimeType($filePath);
        header('Pragma: public'); // required
        header('Expires: 0'); // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private',false);
        header('Content-Type: '. $mime);
        header($contentDispositionField);
        header('Content-Transfer-Encoding: binary');
        header('Connection: close');
        readfile($filePath);
        exit();
    }

    /**
     * 把数据集转换成Tree
     * @param $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param int $root
     * @return array
     */
    public static function tree_bulid($list, $pk='id', $pid = 'pid', $child = 'children', $root = 0)
    {
        // 创建Tree
        $tree = array();
        if (is_array($list)) {
            // 创建基于主键的数组引用
            $refer = array();
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = & $list[$key];
            }

            foreach ($list as $key => $data) {
                // 判断是否存在parent
                $parentId =  $data[$pid];
                if ($root == $parentId) {
                    $tree[] = & $list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent = & $refer[$parentId];
                        $parent[$child][] = & $list[$key];
                    }
                }
            }
        }

        return $tree;
    }

    public static function get_request_payload()
    {
        return Json::decode(Yii::$app->getRequest()->getRawBody(), true);
    }

    public static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }

        $xml .= "</xml>";
        file_put_contents(Yii::getAlias('@frontend/runtime/logs/') . '/sendDataToXml.txt',$xml);

        return $xml;
    }

    public static function numberToChinese($key)
    {
        $arr = ['零', '一', '二', '三', '四', '五', '六', '七', '八', '九'];

        return array_key_exists($key, $arr) ? $arr[$key] : '';
    }

    public static function getRelativePath(string $absolutePath, string $needle = 'uploads')
    {
        if (false !== $fIndex = stripos($absolutePath, $needle))
            return substr($absolutePath, $fIndex);

        return false;
    }

}

?>
