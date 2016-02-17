<?php
/**
 * Eisen Frontend
 * http://eisen-dev.github.io
 *
 * Copyright (c) 2016 Alice Ferrazzi <alice.ferrazzi@gmail.com> - Takuma Muramatsu <t.muramatu59@gmail.com>
 * Dual licensed under the MIT or GPL Version 3 licenses or later.
 * http://eisen-dev.github.io/License.md
 *
 */

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
    public function searchPackage()
    {
        define("INSTALLED", 0);
        define("REPOSITORY", 1);
        $dba = new DbAction();
        $dbh = $dba->Connect();
        //Put form elements into post variables
        // (this is where you would sanitize your data)
        $search = @$_POST['field1'];
        $list = @$_POST['list-action-package'];
        $update = @$_POST['list-action-general'];
        $target_host = @$_POST['target_ipaddress'];

        if ($list == INSTALLED) {
            $return = $this->isInstalled($dba, $dbh, $search, $update, $target_host);
        } elseif ($list == REPOSITORY) {
            $return = $this->isRepository($dba, $dbh, $search, $update, $target_host);
        } else {
            $return = '$list: '.$list.' not recognized';
        }

        return json_encode($return);
    }

    public function isInstalled($dba,$dbh,$search,$update,$target_host){

        $return = [];

        $return['msg'] = '';
        $return['error'] = false;
        if (!isset($search) || empty($search)) {
            $return['error'] = true;
            $package = $dba->installedPackageList($target_host, $dbh);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup"
                   data-modal="open"
                   data-modal-target="test-modal"
                   data-modal-type="test"
                   >';
                $return['msg'] .= "<td class=\"id\">" .
                    $row['installed_pack_id']. "</td>";
                $return['msg'] .= "<td class=\"name\">" .
                    $row['installed_pack_name'] . "</td>";
                $return['msg'] .= "<td class=\"version\">" .
                    $row['installed_pack_version'] . "</td>";
                $return['msg'] .= "<td class=\"summary\">" .
                    $row['installed_pack_summary'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        //Begin form success functionality
        if ($return['error'] === false) {
            $package = $dba->installedPackageSearch($target_host, $dbh, $search);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup"
                   data-modal="open"
                   data-modal-target="test-modal"
                   data-modal-type="test"
                   >';
                $return['msg'] .= "<td class=\"id\">".
                    $row['installed_pack_id']."</td>";
                $return['msg'] .= "<td class=\"name\">" .
                    $row['installed_pack_name'] . "</td>";
                $return['msg'] .= "<td class=\"version\">" .
                    $row['installed_pack_version'] . "</td>";
                $return['msg'] .= "<td class=\"summary\">" .
                    $row['installed_pack_summary'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        return $return;
    }

    public function isRepository($dba,$dbh,$search,$update,$target_host) {
        $return = array();

        $return['msg'] = '';
        $return['error'] = false;
        if (!isset($search) || empty($search)) {
            $return['error'] = true;
            $package = $dba->PackageList($target_host, $dbh);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup"
                   data-modal="open"
                   data-modal-target="test-modal"
                   data-modal-type="test"
                   >';
                $return['msg'] .= "<td class='id'>" .
                    $row['pack_id']."</td>";
                $return['msg'] .= "<td class='name'>" .
                    $row['pack_name'] . "</td>";
                $return['msg'] .= "<td class='version'>" .
                    $row['pack_version'] . "</td>";
                $return['msg'] .= "<td class='summary'>" .
                    $row['pack_summary'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        //Begin form success functionality
        if ($return['error'] === false) {
            $package = $dba->PackageSearch($target_host, $dbh, $search);
            foreach ($package as $i => $row) {
                $return['msg'] .= '<tr class="cell-which-triggers-popup"
                   data-modal="open"
                   data-modal-target="test-modal"
                   data-modal-type="test"
                   >';
                $return['msg'] .= "<td class='id'>" .
                    $row['pack_id'] . "</td>";
                $return['msg'] .= "<td class='name'>" .
                    $row['pack_name'] . "</td>";
                $return['msg'] .= "<td class='version'>" .
                    $row['pack_version'] . "</td>";
                $return['msg'] .= "<td class='summary'>" .
                    $row['pack_summary'] . "</td>";
                $return['msg'] .= '</tr>';
            }
        }
        return $return;
    }
}

$ajaxValidate = new AjaxValidate;
echo $ajaxValidate->searchPackage();