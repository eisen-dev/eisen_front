<?php
$pack_id = $_POST['pack_id'];
$return = "これは".$pack_id."です。 from ajaxtest2.php";


echo json_encode([
	'return' => $return
]);
