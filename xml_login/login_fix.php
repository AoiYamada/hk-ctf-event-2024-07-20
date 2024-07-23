<?php
libxml_disable_entity_loader(true);
$xmlfile = file_get_contents('php://input');
try{
    $dom = new DOMDocument();
    $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
    $creds = simplexml_import_dom($dom);
    $username = $creds->username;
    $password = $creds->password;
    if ($username != 'admin'){
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",1,$username.$username);
    }
    else if ($password != 'admin123'){
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",1,$username);
    }else{
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",0,$username);
    }
}catch (Exception $e){
  $res = "<result><code>1</code><msg>error</msg></result>";
}
echo($res);<?php
libxml_disable_entity_loader(false);
$xmlfile = file_get_contents('php://input');
try{
    $dom = new DOMDocument();
    $dom->loadXML($xmlfile, LIBXML_NOENT | LIBXML_DTDLOAD);
    $creds = simplexml_import_dom($dom);
    $username = $creds->username;
    $password = $creds->password;
    if ($username != 'admin'){
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",1,$username.$username);
    }
    else if ($password != 'admin123'){
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",1,$username);
    }else{
        $res = sprintf("<result><code>%d</code><msg>%s</msg></result>",0,$username);
    }
}catch (Exception $e){
  $res = "<result><code>1</code><msg>error</msg></result>";
}
echo($res);