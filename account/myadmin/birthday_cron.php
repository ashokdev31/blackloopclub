<?php 
    require_once "functions_basic.php";
    
    $today = date("Y-m-d");
    $query = selectPDO("select * from page_details where name = 'birthday'", array());
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $text = $row['note'];
    $query = selectPDO("select * from users where birthday = ? and user_status = '1' and roles is not NULL", array($today));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
    	$fname = $row['fname'];
    	$email = $row['email'];
    	$to = $email;
    	$user_id = $row['id'];
    	$subject = "HAPPY BIRTHDAY {$fname}!";
    	$msg = preg_replace("#FNAME#", $fname, $text);
        $msg = preg_replace("#LNAME#", $lname, $msg);
        $message = $msg;
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                    'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                    'Reply-To: contact@blackloopclub.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        $notification_type = "birthday";
        sendNotification($user_id, $notification_type, "", "", "", "");
    }