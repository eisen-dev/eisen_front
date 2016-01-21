<?php require_once __DIR__ . '/locale.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo _('Variable List'); ?></title>
<?php
require_once __DIR__ .'/parts/head.php';
?>

    <style>
        #popup {
            display: none;
            border: 1px solid black;
        }

        .cell-which-triggers-popup {
            cursor: pointer;
        }

        .cell-which-triggers-popup:hover {
            background-color: yellow;
        }
    </style>
</head>
<?php
    if (isset($_GET['host'])) {
        $package = htmlspecialchars($_GET["host"]);
        echo($package);
    }
    if (isset($_GET['action'])) {
        $action = htmlspecialchars($_GET["action"]);
        echo($action);
    }
    require_once __DIR__ . '/includes/DbAction.php';
    require_once __DIR__ . '/locale.php';
    $dba = new DbAction();
    $dbh = $dba->Connect();
?>
<body>
<!-- TODO better popup menu style -->
<div id="popup" data-name="name" class="dialog">
    <!--<a href="">Hello world!</a>-->
    <p class="item-1"></p>
    <p class="item-2"></p>
</div>
<div class="wrapper">
    <?php require_once __DIR__ . '/parts/navigation.php'; ?>
    <div class="contentswrapper menu-set">
        <main class="contents">
            <div class="section">
                <h2 class="title"><?php echo _('Variable List'); ?></h2>
                <div class="list-tools clearfix">
                    <div class="list-action">
                        <select name="list-action" class="input-list">
                            <option value="0">一括操作</option>
                            <option value="0">更新</option>
                        </select>
                        <input type="submit" value="適用" class="button button--form">
                    </div>
                    <div class="search-box">
                        <input type="text" placeholder="全てのパッケージを検索">
                        <button type="submit" name="submit" class="search-box__button">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="cbox__selectall">
                            <div class="cbox__wrapper">
                                <input type="checkbox" id="cbox-selectall"><label
                                    for="cbox-selectall"></label>
                            </div>
                        </th>
                        <th><?php echo _('ID'); ?></th>
                        <th><?php echo _('host'); ?></th>
                        <th><?php echo _('variable key'); ?></th>
                        <th><?php echo _('variable value'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dba = new DbAction();
                    $dbh = $dba->Connect();
                    $user_id = $me->get_user_id();
                    $machine = $dba->hostManagerActiveList($user_id, $dbh);
                    $rest = new restclient();
                    foreach ($machine as $i => $row) {
                        $variables[] = $rest->variable_list(
                            $row['ipaddress'],
                            $row['port'],
                            $row['username'],
                            $row['password']
                        );
                    }
                    foreach ($variables as $i => $row) {
                        foreach ($row as $x => $var) {
                            # hack for get task_id
                            $uri = $var->uri;
                            $uri = explode('/', $uri);
                            $task_id = $uri[5];
                            $table = '<tr class="cell-which-triggers-popup">
                                    <td><input type="checkbox" id="cbox-' . $task_id . '">
                                    <label for="cbox-' . $task_id . '"></label></td>';
                            $table .= '<td class="task_id">' . ($task_id) . '</td>';
                            $table .= '<td class="manager_host">' . $var->manager_host . '</td>';
                            $table .= '<td class="host">' . $var->host . '</td>';
                            $table .= '<td class="module">' . $var->variable_key . '</td>';
                            $table .= '<td class="command">' . $var->variable_value . '</td></tr>';
                            echo($table);
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <div class="button" data-modal="open" data-modal-target="vars_list-setting">
                    open setting
                </div>
            </div>
        </main>
    </div>
</div>
<!-- set modal before body tag -->
<div class="modal" id="vars_list-setting">
    <div class="modal-wrapper">
        <div class="modal-window">
            <form action="includes/vars_registration.php" method="post">
                <div class="modal-header">
                    <i class="fa fa-times modal-close" data-modal="close"></i>
                    <span class="modal-title">variable settings</span>
                </div>
                <div class="modal-contents">
                    <div class="compact-form">
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>manager host</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="manager_host">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>target host</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="target_host">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>variable_key</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="variable_key">
                            </div>
                        </div>
                        <div class="compact-form-row">
                            <div class="compact-form-item-left">
                                <span>variable_value</span>
                            </div>
                            <div class="compact-form-item-right">
                                <input type="text" name="variable_value">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-ctrl">
                    <input type="submit" name="submit" value="設定して次に進む" class="button">
                </div>
            </form>
        </div>
    </div>
    <div class="modal-overlay" data-modal="close"></div>
</div>
<?php require_once __DIR__ . '/parts/scripts.php'; ?>
<script>
    $(document).ready(function () {
        $(document).on("click", ".cell-which-triggers-popup", function (event) {
            var cell_value1 = $(event.target).closest('tr').find('.task_id').text();
            var cell_value2 = $(event.target).closest('tr').find('.module').text();
            var cell_value3 = $(event.target).closest('tr').find('.command').text();
            //console.log(cell_value);
            if (cell_value1 && cell_value2) {
                showPopup(cell_value1, cell_value2)
            }
        });

        function showPopup(cell_value1, cell_value2) {
            $("#popup").dialog({
                width: 500,
                height: 300,
                open: function () {
                    $(this).find("p.item-1").html("<a href=includes/VariableAction.php?id="
                        + cell_value1 +
                        "\&action=start>Start"
                        + cell_value2 +
                        ":"
                        + cell_value1 +
                        "</a>"
                    );
                    $(this).find("p.item-2").html("<a href=includes/VariableAction.php?id="
                        + cell_value1 +
                        "\&action=result>Result"
                        + cell_value2 +
                        ":"
                        + cell_value1 +
                        "</a>"
                    );
                }
            });
        }
    });
</script>
</body>
</html>
