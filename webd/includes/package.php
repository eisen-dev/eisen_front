<?php

class Package {
    # start session if is not already started
    # always needed for use session
    public function install($package, $user_id, $dbh){
        $stm = $dbh->prepare("select * from machine_information WHERE user_id=:user_id;");
        $stm-> bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stm->execute();
        $data = $stm->fetchAll();
        $cnt  = count($data); //in case you need to count all rows
        var_dump($data);
        foreach ($data as $i => $row)
            $js_host=$row['ipaddress'];
            $js_port=$row['port'];

        print $js_port;
        print $js_host;
        //クライアントに接続
        $server= new jsonRPCClient("http://$js_host:$js_port");
        ini_set('max_execution_time', 0); //300 seconds = 5 mi.12
        $data=$server->install_package($package);
        return $data;
    }
    # check if session is started session
    # return number of session
    public function is_session_started(){
        return session_status();
    }

    # set user_id
    public function set_user_id($user_id){
        $_SESSION['login_user'] = $user_id;
    }
    # get user_id
    public function get_user_id(){
        if( isset( $_SESSION['login_user']) ){
            return $_SESSION['login_user'];
        }else{
            return 'logged off';
        }
    }
}
?>