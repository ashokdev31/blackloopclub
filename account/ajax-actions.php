<?php

require_once "../functions_basic.php";


if(isset($_POST['row_id'])){
	otherPDO("update notifications set read_status = '1' where id = ?", array($_POST['row_id']));
}

if(isset($_POST['marked'])){
	foreach ($_POST['marked'] as $id) {
		otherPDO("update notifications set read_status = '1' where id = ?", array($id));
	}
}

if(isset($_POST['unmarked'])){
	foreach ($_POST['unmarked'] as $id) {
		otherPDO("update notifications set read_status = '0' where id = ?", array($id));
	}
}

if(isset($_POST['deleted'])){
	foreach ($_POST['deleted'] as $id) {
		otherPDO("delete from notifications where id = ?", array($id));
	}
}

if(isset($_POST['file_link'])){ 
	echo $_POST['file_link'];
}

if(isset($_POST['user_id']) && isset($_POST['row']) && isset($_POST['rowperpage'])){
	$html = getNotifications($_POST['user_id'], $_POST['row'], $_POST['rowperpage']);

	echo $html[0];
}