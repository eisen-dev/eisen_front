<?php
require_once __DIR__."/restclient.php";
require_once __DIR__ . '/DbAction.php';
require_once __DIR__."/session.php";

class ajaxValidate {
    function formValidate() {
        //Put form elements into post variables (this is where you would sanitize your data)
        $field1 = @$_POST['field1'];
/*
        $me = new Session();
        $me->start_session();
        $me->is_session_started();


        $user_id = $me->get_user_id();*/
        $module="Ansible";
        $ipaddress="192.168.233.130";
        $port="5000";
        $username="ansible";
        $password="default";
        $rest = new restclient();

        $task_module="shell";
        $hosts="192.168.233.129";
        $command= "equery --no-pipe --quiet list ".$field1."";

        $task_id=$rest->task_register($ipaddress,$port,$username,$password,$hosts,$command,$task_module);
        $package=$rest->tasks_run($ipaddress,$port,$username,$password,$task_id);
        //var_dump($package);
        //Establish values that will be returned via ajax
        $return = array();
        $return['msg'] = '';
        $return['error'] = false;
        if (!isset($field1) || empty($field1)){
            $return['error'] = true;
            $return['msg'] .= '<li>Error: Field1 is empty.</li>';
        }
        //Begin form success functionality
        if ($return['error'] === false) {
            foreach ($package as $i => $row) {
                //echo($i);
                foreach ($row->contacted as $i => $row) {
                    foreach (explode("\n", $row->stdout) as $item) {
                        $return['msg'] .= '<tr class="cell-which-triggers-popup">';
                        $return['msg'] .= "<td></td>";
                        $return['msg'] .= "<td class=\"item\">" . $item . "</td>";
                        $return['msg'] .= '</tr>';
                    }
                }
            }
        }
        $rest->tasks_delete($ipaddress,$port,$username,$password,$task_id);
        return json_encode($return);
    }
}
$ajaxValidate = new ajaxValidate;
echo $ajaxValidate->formValidate();
?>