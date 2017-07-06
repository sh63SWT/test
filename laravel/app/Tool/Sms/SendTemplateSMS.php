<?php
namespace App\Tool\Sms;
use App\Tool\Result;

class SendTemplateSMS
{
    //主帐号
    protected $accountSid;

    //主帐号Token
    protected $accountToken;

    //应用Id
    protected $appId;

    //请求地址，格式如下，不需要写https://
    protected $serverIP = 'app.cloopen.com';

    //请求端口
    protected $serverPort = '8883';

    //REST版本号
    protected $softVersion = '2013-12-26';

    public function __construct()
    {
        $this->accountSid = env('ACCOUNT_SID');
        $this->accountToken = env('ACCOUNT_TOKEN');
        $this->appId = env('APP_ID');
    }

    /**
     * 发送模板短信
     * @param to 手机号码集合,用英文逗号分开
     * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
     * @param $tempId 模板Id
     */
    function send($to, $datas, $tempId)
    {
        $rest = new REST($this->serverIP, $this->serverPort, $this->softVersion);
        $rest->setAccount($this->accountSid, $this->accountToken);
        $rest->setAppId($this->appId);
        //实例化对象
        $res = new Result();
        // 发送模板短信
        $result = $rest->sendTemplateSMS($to, $datas, $tempId);
        if ($result == NULL) {
            $res->status = 1;
            $res->message = '服务器错误';
        }
        if ($result->statusCode != 0) {
           $res->status = '2';
           $res->message = '发送失败';
        } else {
            $res->status = 0;
            $res->message = '发送成功';
        }

        return $res;
    }
}
//Demo调用,参数填入正确后，放开注释可以调用 
//sendTemplateSMS("手机号码","内容数据","模板Id");
