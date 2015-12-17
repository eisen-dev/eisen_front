<?php
require_once __DIR__ . '/DbAction.php';

/**
 * Test
 * @return string
 */
class AjaxValidate
{
    /**
     * Test
     * @return string
     */
    function searchPackage()
    {
        define("NOT_SELECTED", 0);
        define("INSTALLED", 1);
        define("REPOSITORY", 2);
        $return =null;
        $dba = new DbAction();
        $dbh = $dba->Connect();
        //Put form elements into post variables
        // (this is where you would sanitize your data)
        $search = @$_POST['field1'];
        $list = @$_POST['list-action-package'];
        $update = @$_POST['list-action-general'];
        $pack_sys_id = 1;

        if ($list == NOT_SELECTED) {
            var_dump($list);
        }
        if ($list == INSTALLED) {
            $return = $this->isInstalled($dba, $dbh, $search, $update, $pack_sys_id);
        }
        if ($list == REPOSITORY) {
            $return = $this->isRepository($dba, $dbh, $search, $update, $pack_sys_id);
        }

        return json_encode($return);
    }

    function isInstalled($dba,$dbh,$search,$update,$pack_sys_id){

        $return = array();

        $return['msg'] = '';
        $return['error'] = false;
        if (!isset($search) || empty($search)) {
            $return['error'] = true;
            $package = $dba->installedPackageList($pack_sys_id, $dbh);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup">';
                $return['msg'] .= "<td></td>";
                $return['msg'] .= "<td>$i</td>";
                $return['msg'] .= "<td class=\"item\">" .
                    $row['installed_pack_name'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        //Begin form success functionality
        if ($return['error'] === false) {
            $package = $dba->installedPackageSearch($pack_sys_id, $dbh, $search);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup">';
                $return['msg'] .= "<td></td>";
                $return['msg'] .= "<td>$i</td>";
                $return['msg'] .= "<td class=\"item\">" .
                    $row['installed_pack_name'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        return $return;
    }

    function isRepository($dba,$dbh,$search,$update,$pack_sys_id) {
        $return = array();

        $return['msg'] = '';
        $return['error'] = false;
        if (!isset($search) || empty($search)) {
            $return['error'] = true;
            $package = $dba->PackageList($pack_sys_id, $dbh);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup">';
                $return['msg'] .= "<td></td>";
                $return['msg'] .= "<td>$i</td>";
                $return['msg'] .= "<td class=\"item\">" .
                    $row['pack_name'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        //Begin form success functionality
        if ($return['error'] === false) {
            $package = $dba->PackageSearch($pack_sys_id, $dbh, $search);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup">';
                $return['msg'] .= "<td></td>";
                $return['msg'] .= "<td>$i</td>";
                $return['msg'] .= "<td class=\"item\">" .
                    $row['pack_name'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        return $return;
    }
}

$ajaxValidate = new AjaxValidate;
echo $ajaxValidate->searchPackage();