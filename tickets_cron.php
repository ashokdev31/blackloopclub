<?php 
    require_once "functions_basic.php";
    
    $today = date("Y-m-d H:i:s");
    $query = selectPDO("select * from tickets where ticket_status = '1' and user_id is not NULL and flag = '0'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $query2 = selectPDO("select * from tickets where parent = ? order by date_posted desc limit 1", array($row['id']));
        while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
            if($row2['admin']!=NULL){
                // $date = new DateTime(date('Y-m-d H:i:s', strtotime($row2['date_posted'])));
                $date = date('Y-m-d H:i:s', strtotime($row2['date_posted']));
                $diff = $today->diff($date);
                $hours = $diff->h;
                $hours = $hours + ($diff->days*24);
                if($hours>=72){
                    otherPDO("update tickets set ticket_status = '2' where id = ?", array($row['id']));
                	$user_id = $row['id'];
                    $subject = "Re: ".$row['subject'];
                    $id = array($user_id, $subject);
                    $notification_type = "ticket";
                    sendNotification($id, $notification_type, "", "", "", "");
                }
            }
        }
    }