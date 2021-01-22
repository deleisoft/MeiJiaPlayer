<?php
header("Content-type: text/html; charset=utf-8");

$json_raw = file_get_contents("php://input");
if($json_raw == 'delall'){
    file_put_contents('songdate.txt','');
}else{
    if(json_decode($json_raw)){
        file_put_contents('songdate.txt',$json_raw);
    }

}
$ret = array ('code'=>'200');
echo json_encode($ret);
?>