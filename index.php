<?php

$url = isset($_GET['url'])? $_GET['url']: null;
$url = rtrim($url, '/');

if( $url == '' ){
    include 'api/v1/documentation/index.php';
    return false;
}

$url = explode('/', $url);

$version = array_shift($url);
$controller_name = ucfirst(array_shift($url)) . 'Controller';
$controller_file = 'api/'.$version.'/controllers/' . $controller_name .'.php';

if( file_exists($controller_file) ){
    require $controller_file;
    $controller = new $controller_name;

    $controller_method = 'get_'.array_shift($url);

    if( method_exists($controller, $controller_method) ){
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
    if(  $version != 'docs'){
        echo json_encode( array('error'=>"URL doesn't exist.") , JSON_UNESCAPED_UNICODE);
    }else{
        require("vendor/autoload.php");
        $openapi = \OpenApi\Generator::scan(['api/v1/controllers']);
        header('Content-Type: application/yaml');
        echo $openapi->toYaml();
    }
}
?>