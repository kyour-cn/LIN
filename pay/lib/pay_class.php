<?php
//本套系统的支付API类文件

require_once($pmp."pay/epay.config.php");
require_once($pmp."pay/lib/epay_submit.class.php");

class Pay_class{
    public $parameter=null;
    public $h1='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>在线支付</title>
</head>';
    public $h2='</body></html>';

    public function set($p)
    {
        $this->parameter = $p;
    }

    public function get($a=false){
      if($this->parameter==null){
        return "";
      }
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
      if($a){
        return $this->h1.$html_text.$this->h2;
      }
return $html_text;
}
}