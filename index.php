<?php

$url = isset($_GET['url'])? $_GET['url']: null;
$url = rtrim($url, '/');
$url = explode('/', $url);

if(empty($url)) return false;
 
$controller_name = ucfirst(array_shift($url)) . 'Controller';

$controller_file = 'controllers/' . $controller_name .'.php';

if( file_exists($controller_file) ){
    require $controller_file;
    $controller = new $controller_name;

    $controller_method = 'get_'.array_shift($url);

    if( method_exists($controller, $controller_method) ){
        // header('Content-type: application/json');

        if( !empty( $url ) ){
            $res = $controller->{$controller_method}( $url );
            
        }else{
            $res = array('error'=>"Parameters weren't found.");   
        }
        
        echo json_encode($res, JSON_UNESCAPED_UNICODE);   
    }else{
        echo json_encode( array('error'=>"Call a method") , JSON_UNESCAPED_UNICODE);
    }
}else{
    echo json_encode( array('error'=>"URL doesn't exist.") , JSON_UNESCAPED_UNICODE);
}
?>