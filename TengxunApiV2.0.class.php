<?php
/*
 * 自己写的腾讯QQ互联的类
 * 开始  2014-01-16 
 * 更新  2014-01-17
 * 更新历史 
 * 2014-01-17 修改post方法
 * diandianxiyu <diandianxiyu@foxmail.com>
 */

/**
 * 接口实际操作类
 */
class TengxunClientV2 {
    private  $keysArr,$OAuth;
            function __construct($access_token, $openid) {
        $this->keysArr = array(
            "oauth_consumer_key" => Yii::app()->params['QQ_APP_ID'],
            "access_token" => $access_token,
            "openid" => $openid
        );
        
        $this->OAuth=new TengxunTOAuthV2($this->keysArr);
    }

    //===================调用接口的方法===================================//
    
    
    //---------------------------------------访问用户资料---------------------------------------------------------------------------------//
    
    /**
     * 取登录用户在QQ空间的信息，包括昵称、头像、性别及黄钻信息（包括黄钻等级、是否年费黄钻等）。
     * https://graph.qq.com/user/get_user_info
     * 参数：format:json,xml 返回的格式
     */
    function get_user_info($format = 'json'){
        $param=array(
             'format'=>$format,
        );
        return $this->get('user/get_user_info',$param);
    }

    //---------------------------------------访问用户QQ会员信息------------------------------------------------------------------------//
    
    /**
     * 获取已登录用户的关于QQ会员业务的基本资料。
基本资料包括以下信息：是否为“普通包月会员”，是否为“年费会员”，QQ会员等级信息，是否为“豪华版QQ会员”，是否为“钻皇会员”，是否为“SVIP”。
     * https://graph.qq.com/user/get_vip_info
     * @param type $format json,xml 返回的格式
     * @return type
     */
     
    function get_vip_info($format = 'json'){
         $param=array(
             'format'=>$format,
        );
         return $this->get('user/get_vip_info',$param);
    }
    /**
     * 获取已登录用户的关于QQ会员业务的详细资料。
详细资料包括：用户会员的历史属性，用户会员特权的到期时间，用户最后一次充值会员业务的支付渠道，用户开通会员的主要驱动因素。
     * https://graph.qq.com/user/get_vip_rich_info
     * @param type $format json,xml 返回的格式
     */
    function get_vip_rich_info($format = 'json'){
         $param=array(
             'format'=>$format,
        );
         return $this->get('user/get_vip_rich_info',$param);
    }


    //-------------------------------------分享内容到我的腾讯微博--------------------------------------------------------------------//
    /**
     * 获取腾讯微博登录用户的用户资料
     * https://graph.qq.com/user/get_info
     * HTTP请求方式    GET
     * 参数：format:json,xml 返回的格式
     */
    function get_info($format = 'json') {
        $param=array(
            'format'=>$format,
        );
        return  $this->get('user/get_info', $param);
    }
    
     //-----------------------------------------获得我的微博好友信息------------------------------------------------------------------//
    /**
     * 获取登录用户的听众列表。
     * 
     * @param type $reqnum 请求获取的听众个数。取值范围为1-30。
     * @param type $startindex 请求获取听众列表的起始位置。第一页：0； 继续向下翻页：reqnum*（page-1）。
     * @param type $mode 获取听众信息的模式，默认值为0。0：旧模式，新添加的听众信息排在前面，最多只能拉取1000个听众的信息。 1：新模式，可以拉取所有听众的信息，暂时不支持排序。
     * @param type $install 判断获取的是安装应用的听众，还是未安装应用的听众。 0：不考虑该参数；1：获取已安装应用的听众信息； 2：获取未安装应用的听众信息。
     * @param type $sex 按性别过滤标识，默认为0。此参数当mode=0时使用，支持排序。 1：获取的是男性听众信息；2：获取的是女性听众信息； 0：不进行性别过滤，获取所有听众信息。
     * @param type $format
     */
    function get_fanslist($reqnum=10,$startindex=0,$mode=0,$install=0,$sex=0,$format='json'){
        $param=array(
            'reqnum'=>$reqnum,
            'startindex'=>$startindex,
            'mode'=>$mode,
            'install'=>$install,
            'sex'=>$sex,
            'format'=>$format,
        );
        return  $this->get('relation/get_fanslist', $param);
    }
    
     /**
     * 获取登录用户收听的人的列表。
     * 
     * @param type $reqnum 请求获取收听的个数。取值范围为1-30。
     * @param type $startindex 请求获取收听列表的起始位置。第一页：0； 继续向下翻页：reqnum*（page-1）。
     * @param type $mode 获取收听信息的模式，默认值为0。0：旧模式，新添加的听众信息排在前面，最多只能拉取1000个收听的信息。 1：新模式，可以拉取所有收听的信息，暂时不支持排序。
     * @param type $install 判断获取的是安装应用的收听，还是未安装应用的收听。 0：不考虑该参数；1：获取已安装应用的收听信息； 2：获取未安装应用的收听信息。
     * @param type $sex 按性别过滤标识，默认为0。此参数当mode=0时使用，支持排序。 1：获取的是男性收听信息；2：获取的是女性收听信息； 0：不进行性别过滤，获取所有收听信息。
     * @param type $format
     */
    function get_idollist($reqnum=10,$startindex=0,$mode=0,$install=0,$sex=0,$format='json'){
        $param=array(
            'reqnum'=>$reqnum,
            'startindex'=>$startindex,
            'mode'=>$mode,
            'install'=>$install,
            'sex'=>$sex,
            'format'=>$format,
        );
        return  $this->get('relation/get_idollist', $param);
    }
    
    /**
     * 发表一条微博信息（纯文本）到腾讯微博平台上。 注意连续两次发布的微博内容不可以重复。
     * https://graph.qq.com/t/add_t
     */
    function add_t($content,$format='json'){
         $param=array(
            'content'=>$content,
            'format'=>$format,
        );
        return $this->post('t/add_t', $param);
    }
    
    /**
     * 代理get,直接返回数组
     * @param type $url
     * @param type $param
     * @param type $ismerge
     * @return type
     */
    private function get($url,$param,$ismerge){
        return $this->objToArr(json_decode($this->OAuth->get($url, $param,$ismerge)));
    }
    
    /**
     * 代理post，直接返回数组
     * @param type $url
     * @param type $param
     * @param type $ismerge
     * @return type
     */
    private function post($url,$param,$ismerge){
        return $this->objToArr(json_decode($this->OAuth->post($url, $param,$ismerge)));
    }
    //=======================私有方法==================================//
     //php 对象到数组转换
     private function objToArr($obj) {
        if (!is_object($obj) && !is_array($obj)) {
            return $obj;
        }
        $arr = array();
        foreach ($obj as $k => $v) {
            $arr[$k] = $this->objToArr($v);
        }
        return $arr;
    }
    

}

/**
 * 认证类
 */
class TengxunTOAuthV2 {

    private  $apiUrl='https://graph.qq.com/';
    private $keyarr;
    private $oauthkey;
            
    function __construct($keyarr) {
        $this->keyarr=$keyarr;
        $this->oauthkey=array(
            "appid" => Yii::app()->params['QQ_APP_ID'],
            "appkey" => Yii::app()->params['QQ_APP_KEY'],
            "callback" => Yii::app()->params['QQ_callback'],
            "scope" => Yii::app()->params['QQ_scope'],
            "errorReport" => Yii::app()->params['QQ_errorReport'],
            "storageType" => Yii::app()->params['QQ_storageType'],
        );
    }
    //================通过Authorization Code获取Access Token======================//
    
    public function getAccessTokenByCode($code,$state){
        //https://graph.qq.com/oauth2.0/token
        //?grant_type=authorization_code&client_id=[YOUR_APP_ID]&client_secret=[YOUR_APP_Key]
        //&code=[The_AUTHORIZATION_CODE]&state=[The_CLIENT_STATE]&redirect_uri=[YOUR_REDIRECT_URI]
        $oauthkey=$this->oauthkey;
         $param=array(
            'grant_type'=>'authorization_code',
            'client_id'=>  $oauthkey['appid'],
            'client_secret'=>$oauthkey['appkey'],
            'code'=>$code,
            'state'=>$state,
            'redirect_uri'=>$oauthkey['callback'],
        );
        //return $param;
         $tokenstring=$this->get("oauth2.0/token", $param,false);
        return $this->returnStringToArray($tokenstring);
        //return explode("&", $this->get("oauth2.0/token", $param,0));
    }
    //====================使用Access Token来获取用户的OpenID=====================//
    
    public  function getOpenIDByAccessToken($accesstoken){
         $param=array(
             'access_token'=>$accesstoken
             );
         $response=  $this->get('oauth2.0/me', $param);
         if (strpos($response, "callback") !== false) {

            $lpos = strpos($response, "(");
            $rpos = strrpos($response, ")");
            $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
        }
         $arr=json_decode($response);
         return array(
             'openid'=>$arr->openid
         );
    }
    //===============通过Authorization Code获取Access Token 和 OpenID=================//
    
    function getAccessTokenOpenIDByCode($code,$state){
        $tokenarr=  $this->getAccessTokenOpenIDByCode($code, $state);
        $openidarr=  $this->getOpenIDByAccessToken($tokenarr['access_token']);
        return array_merge($openidarr,$tokenarr);
        
    }
    //=======================获取数据===================================//

    /**
     * combineURL
     * 拼接url
     * @param string $baseURL   基于的url
     * @param array  $keysArr   参数列表数组
     * @return string           返回拼接的url
     */
    public function combineURL($baseURL, $keysArr,$ismerge=true) {
      //  $ismerge=$ismerge?$ismerge:1;
        $combined =  $this->apiUrl. $baseURL . "?";
        $valueArr = array();
        //合并数组
        $oatharr=  $this->keyarr;
        if($ismerge){
          
        $keysArr=  array_merge($oatharr,$keysArr);
       }
        foreach ($keysArr as $key => $val) {
            $valueArr[] = "$key=$val";
        }

        $keyStr = implode("&", $valueArr);
        $combined .= ($keyStr);
        return $combined;
    }
    /**
     * 合并数组到参数中，目的是将token和openid传入参数中
     * @param type $keysArr
     */
    function combineArr($keysArr){
        //合并数组
        $oatharr=  $this->keyarr;
        $keys=  array_merge($oatharr,$keysArr);
        return $keys;
    }

    /**
     * get_contents
     * 服务器通过get请求获得内容
     * @param string $url       请求的url,拼接后的
     * @return string           请求返回的内容
     */
    public function get_contents($url) {
        if (ini_get("allow_url_fopen") == "1") {
            $response = file_get_contents($url);
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $response = curl_exec($ch);
            curl_close($ch);
        }

        //-------请求为空
        if (empty($response)) {
           // $this->error->showError("50001");
        }

        return $response;
    }
    /**
     * get
     * get方式请求资源
     * @param string $url     基于的baseUrl
     * @param array $keysArr  参数列表数组      
     * @return string         返回的资源内容
     */
    public function get($url, $keysArr,$ismerge) {
        $combined = $this->combineURL($url, $keysArr,$ismerge);
        return $this->get_contents($combined);
    }

    /**
     * post
     * post方式请求资源
     * @param string $url       基于的baseUrl
     * @param array $keysArr    请求的参数列表
     * @param int $flag         标志位
     * @return string           返回的资源内容
     */
    public function post($url, $keysArr, $flag = 0) {
        $combined=  $this->combineURL($url);
   
        $keysArr=  $this->combineArr($keysArr);
        $ch = curl_init();
        if (!$flag)
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $keysArr);
        curl_setopt($ch, CURLOPT_URL, $combined);
        $ret = curl_exec($ch);

        curl_close($ch);
 
        return $ret;
    }
    
    
    //=======================私有方法==================================//
    /**
     * 将格式为 access_token=YOUR_ACCESS_TOKEN&expires_in=3600 的字符串转化成数组
     */
    private function returnStringToArray($string){
        //$string="access_token=YOUR_ACCESS_TOKEN&expires_in=3600&reesasdasd=safdsa";
        $arr1=  explode('&', $string);
        $arr2=array();
        foreach ($arr1 as $key => $value) {
            $arr=  explode("=", $value);
            $arr2[$arr[0]]=$arr[1];
        }
        return $arr2;
    }
    
    

}
