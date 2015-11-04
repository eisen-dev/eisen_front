<?php

/**
 * Created by PhpStorm.
 * User: IT College
 * Date: 2015/11/04
 * Time: 23:46
 */
class JsAction
{
    // Connect to Json-RPC
    public function ClientConnect($js_host,$js_port){
        //クライアントに接続
        $server= new jsonRPCClient("http://$js_host:$js_port");
        ini_set('max_execution_time', 0); //300 seconds = 5 mi.12
        return $server;
    }

}