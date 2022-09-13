<?php
session_start();
error_reporting(E_ALL);
require_once "db.php";
date_default_timezone_set('Africa/Lagos');


function selectPDO($query, $param){
    global $global_pdo_user;
    global $global_pdo_pass;
    global $global_pdo_db;
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=".$global_pdo_db, $global_pdo_user, $global_pdo_pass);
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $dbh->exec("SET CHARACTER SET utf8");

        $query = $dbh->prepare($query);
        $query->execute($param);

    } catch (PDOException $e) {
        print "Error! : " . $e->getMessage() . "<br/>";
        die();
    }
    return $query;
}

function otherPDO($query, $param){
    global $global_pdo_user;
    global $global_pdo_pass;
    global $global_pdo_db;
    try {
        $dbh = new PDO("mysql:host=localhost;dbname=".$global_pdo_db, $global_pdo_user, $global_pdo_pass);
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $dbh->exec("SET CHARACTER SET utf8");

        $query = $dbh->prepare($query);
        $query->execute($param);

    } catch (PDOException $e) {
        print "Error! : " . $e->getMessage() . "<br/>";
        die();
    }
}

function download($filename){

    $fileinfo = pathinfo($filename);
    $sendname = $fileinfo['filename'] . '.' . strtoupper($fileinfo['extension']);
    header('Content-Type: application/pdf');
    header("Content-Disposition: attachment; filename=\"$sendname\"");
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
}

if(isset($_POST['download_brochure'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    $file = "./img/brochure/BlackloopClub-Brochure-March2018.pdf";

    do{
        $hash = generateRandomString(50);
        $query = selectPDO("select * from email_subscribers where hash = ?", array($hash));
    }while($query->rowCount()>0);
    $query = selectPDO("select * from email_subscribers where email = ?", array($email));
    if($query->rowCount()==0){
        otherPDO("insert into email_subscribers (fname, lname, email, hash, link, date_posted) values (?,?,?,?,?,?)", array($fname, $lname, $email, $hash, $file, $date));
    }else{
        otherPDO("update email_subscribers set hash = ?, link = ? where email = ?", array($hash, $file, $email));
    }

    // send message
    
    // $link = "https://www.blackloopclub.com/thank-you?x={$email}&y={$hash}";
    // $to      = $email;
    // $subject = "Your Download Link!";
    // $message = "Dear {$fname},<br/><br/>Please click <a href='{$link}'>HERE</a> to download the Blackloop Club Brochure.<br/><br/>Thank you!<br/><br/><br/>Blackloop Club Team";
    // $message = wordwrap($message, 70, "\r\n");
    // $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
    //                     'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
    //                 'Reply-To: contact@blackloopclub.com' . "\r\n" .
    //                 'X-Mailer: PHP/' . phpversion();

    // mail($to, $subject, $message, $headers);

    // echo '<script type="text/javascript"> 
    //         swal("Success!", "Download link has been sent to your mailbox!", "success"); 
    //     </script>';

}

if(isset($_POST['subscribe'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    $query = selectPDO("select * from email_subscribers where email = ?", array($email));
    if($query->rowCount()==0){
        otherPDO("insert into email_subscribers (fname, lname, email, date_posted) values (?,?,?,?)", array($fname, $lname, $email, $date));
    }

    // send message
    $to      = $email;
    $subject = "Thank Your For Subscribing to Our Newsletters!";
    $message = "Dear {$fname},<br/><br/>Your FREE subscription to our email newsletter service was successful!<br/><br/>Thank you!<br/><br/><br/>Blackloop Club Team";
    $message = wordwrap($message, 70, "\r\n");
    $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
            'Reply-To: contact@blackloopclub.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
    $subscribe_success = "";
}

function generateRandomString($length) {
    $characters = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function generateInvoiceNum() {
    do{
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString = "BLC".$randomString;
        $query = selectPDO("select * from online_transactions where merchant_ref = ?", array($randomString));
    }while ($query->rowCount()>0);
    return $randomString;
}

function createShifts(){

    for($i=1; $i<8; $i++){
        // get stopper position
        $stopper_date = "";
        $query = selectPDO("select * from users where user_status = '1' and stopper = ? and roles is NULL", array($i));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $stopper_date = $row['date_shifted'];
        }

        if($stopper_date != ""){
            // check if there are 6 people in the system
            $query = selectPDO("select * from users where date_shifted >= ? and user_level = ? and user_status = '1' and roles is NULL order by date_shifted asc", array($stopper_date, $i));
        }else{
            // check if there are 6 people in the system
            $query = selectPDO("select * from users where user_level = ? and user_status = '1' and roles is NULL order by date_shifted asc", array($i));
        }

        if($query->rowCount()>5){
            // get first user on queue
            $query = selectPDO("select * from users where user_level = ? and user_status = '1' and roles is NULL order by date_activated asc", array($i));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $next_user = $row['id'];

            //remove stopper from old user if it exists
            otherPDO("update users set stopper = '' where stopper = ?", array($i));
            
            // move the selected user to next level
            $date = date("Y-m-d H:i:s");
            if($i==7){$next_level="exclusive";}else{$next_level = $i+1;}
            otherPDO("update users set user_level = ?, date_modified = ?, date_shifted = ?, stopper = ? where id = ?", array($next_level, $date, $date, $i, $next_user));

            // pay level bonus
            // retrieve shopping bonus
            $query = selectPDO("select * from payout_settings where type = 'level' and level = ?", array($i));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $level_bonus = $row['amount'] * $row['exchange'];
            }

            // retrieve wallet balance
            $query = selectPDO("select * from accounts where user_id = ?", array($next_user));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $wallet_bal = $row['wallet_bal'] + $level_bonus;
                $voucher_bal = $row['voucher_bal'];
                $car = $row['car'];
                $house = $row['house'];
                $shopping = $row['shopping'];
            }

            // credit the user with shopping bonus
            otherPDO("update accounts set wallet_bal = ? where user_id = ?", array($wallet_bal, $next_user));

            // record bonus in payouts
            otherPDO("insert into payouts (user_id, level, type, amount, date_posted) values (?,?,?,?,?)", array($next_user, $i, "level", $level_bonus, $date));

            // SEND MESSAGE TO USER TO NOTIFY LEVEL CHANGE AND LEVEL BONUS EARNED
            $notification_type = "level_change";
            sendNotification($next_user, $notification_type, $level_bonus, $wallet_bal, "", $i);

            // check if next user is qualified for shopping bonus
            if($shopping=="0" && $next_level >= 5){
                // retrieve referral benchmark for shopping
                $query = selectPDO("select * from payout_settings where type = 'shopping'", array());
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $shopping_benchmark = $row['amount'];
                }

                $query = selectPDO("select * from referrals where sponsor_id = ?", array($next_user));
                if($query->rowCount() >= $shopping_benchmark){
                    // retrieve shopping bonus
                    $query = selectPDO("select * from payout_settings where type = 'shopping_bonus'", array());
                    while($row=$query->fetch(PDO::FETCH_ASSOC)){
                        $shopping_bonus = $row['amount'] * $row['exchange'];
                    }

                    // credit the user with shopping bonus
                    otherPDO("update accounts set shopping = '1' where user_id = ?", array($next_user));
                    $voucher_bal += $shopping_bonus;
                    otherPDO("update accounts set voucher_bal = ? where user_id = ?", array($voucher_bal, $next_user));

                    // record bonus in payouts
                    otherPDO("insert into payouts (user_id, type, amount, date_posted) values (?,?,?,?)", array($next_user, "shopping", $shopping_bonus, $date));

                    // SEND MESSAGE TO USER THAT SHOPPING BONUS HAS BEEN CREDITED
                    $notification_type = "shopping_bonus";
                    sendNotification($next_user, $notification_type, $shopping_bonus, "", $voucher_bal, "");
                }
            }

            // check if next user is qualified for car bonus
            if($car=="0" && ($next_level == 7 || $next_level == "exclusive")){
                // retrieve referral benchmark for car
                $query = selectPDO("select * from payout_settings where type = 'car'", array());
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $car_benchmark = $row['amount'];
                }

                $query = selectPDO("select * from referrals where sponsor_id = ?", array($next_user));
                if($query->rowCount() == $car_benchmark){
                    // credit the user with a car
                    otherPDO("update accounts set car = '1' where user_id = ?", array($next_user));

                    // record bonus in payouts
                    otherPDO("insert into payouts (user_id, type, date_posted) values (?,?,?)", array($next_user, "car", $date));

                    // SEND MESSAGE TO USER THAT CAR BONUS HAS BEEN CREDITED
                    $notification_type = "car_bonus";
                    sendNotification($next_user, $notification_type, "", "", "", "");
                }
            }

            // check if next user is qualified for house bonus
            if($house=="0" && $next_level == "exclusive"){
                // retrieve referral benchmark for house
                $query = selectPDO("select * from payout_settings where type = 'house'", array());
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $house_benchmark = $row['amount'];
                }

                $query = selectPDO("select * from referrals where sponsor_id = ?", array($next_user));
                if($query->rowCount() == $house_benchmark){
                    // credit the user with a house
                    otherPDO("update accounts set house = '1' where user_id = ?", array($next_user));

                    // record bonus in payouts
                    otherPDO("insert into payouts (user_id, type, date_posted) values (?,?,?)", array($next_user, "house", $date));


                    // SEND MESSAGE TO USER THAT HOUSE BONUS HAS BEEN CREDITED
                    $notification_type = "house_bonus";
                    sendNotification($next_user, $notification_type, "", "", "", "");
                }
            }

        }
    }

}


function payBonuses($referral_code, $user_id, $user_type, $date){
    // retrieve sponsor's id
    $query = selectPDO("select * from users where user_code = ? and user_status = '1' and roles is NULL", array($referral_code));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $referral_id = $row['id'];
        $referral_level = $row['user_level'];
        $referral_type = $row['user_type'];
    }

    if(isset($referral_id)){
        // record new referral
        otherPDO("insert into referrals (sponsor_id, user_id, user_type, date_posted) values (?,?,?,?)", array($referral_id, $user_id, $user_type, $date));
        
        // retrieve referral table id
        $query = selectPDO("select * from referrals where sponsor_id = ? and user_id = ? and user_type = ?", array($referral_id, $user_id, $user_type));
        while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $ref_id = $row['id'];
        }

        // get amount paid for the plan
        if($referral_type=="privilege"){
            $query = selectPDO("select * from payout_settings where type = 'privilege'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $amount = $row['amount'] * $row['exchange'];
            }
            // calculate referral bonus
            $query = selectPDO("select * from payout_settings where type = 'referral'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $referral_bonus = $row['amount'] * $amount / 100;
            }
        }elseif($referral_type=="sellerator"){
            $query = selectPDO("select * from payout_settings where type = 'sellerator'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $referral_bonus = $row['amount'] * $row['exchange'];
            }
        }

        // credit user account with bonus
        $query = selectPDO("select * from accounts where user_id = ?", array($referral_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $wallet_bal = $row['wallet_bal'] + $referral_bonus;
            $voucher_bal = $row['voucher_bal'];
            $car = $row['car'];
            $house = $row['house'];
            $shopping = $row['shopping'];
        }
        otherPDO("update accounts set wallet_bal = ? where user_id = ?", array($wallet_bal, $referral_id));

        // record bonus in payouts
        otherPDO("insert into payouts (user_id, type, amount, referrals_id, date_posted) values (?,?,?,?,?)", array($referral_id, "referral", $referral_bonus, $ref_id, $date));

        // SEND MESSAGE TO USER THAT REFERRAL BONUS HAS BEEN CREDITED
        $notification_type = "referral_bonus";
        sendNotification($referral_id, $notification_type, $referral_bonus, $wallet_bal, "", "");


        // check if referral user is qualified for shopping bonus
        if($shopping=="0" && $referral_level >= 5){
            // retrieve referral benchmark for shopping
            $query = selectPDO("select * from payout_settings where type = 'shopping'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $shopping_benchmark = $row['amount'];
            }

            $query = selectPDO("select * from referrals where sponsor_id = ?", array($referral_id));
            if($query->rowCount() == $shopping_benchmark){
                // retrieve shopping bonus
                $query = selectPDO("select * from payout_settings where type = 'shopping_bonus'", array());
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $shopping_bonus = $row['amount'] * $row['exchange'];
                }

                // credit the user with shopping bonus
                otherPDO("update accounts set shopping = '1' where user_id = ?", array($referral_id));
                $voucher_bal += $shopping_bonus;
                otherPDO("update accounts set voucher_bal = ? where user_id = ?", array($voucher_bal, $referral_id));

                // record bonus in payouts
                otherPDO("insert into payouts (user_id, type, amount, date_posted) values (?,?,?,?)", array($referral_id, "shopping", $shopping_bonus, $date));

                // SEND MESSAGE TO USER THAT SHOPPING BONUS HAS BEEN CREDITED
                $notification_type = "shopping_bonus";
                sendNotification($referral_id, $notification_type, $shopping_bonus, "", $voucher_bal, "");
            }
        }
        
        // check if referral user is qualified for car bonus
        if($car=="0" && ($referral_level == 7 || $referral_level == "exclusive")){
            // retrieve referral benchmark for car
            $query = selectPDO("select * from payout_settings where type = 'car'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $car_benchmark = $row['amount'];
            }

            $query = selectPDO("select * from referrals where sponsor_id = ?", array($referral_id));
            if($query->rowCount() == $car_benchmark){
                // credit the user with a car
                otherPDO("update accounts set car = '1' where user_id = ?", array($referral_id));

                // record bonus in payouts
                otherPDO("insert into payouts (user_id, type, date_posted) values (?,?,?)", array($referral_id, "car", $date));

                // SEND MESSAGE TO USER THAT CAR BONUS HAS BEEN CREDITED
                $notification_type = "car_bonus";
                sendNotification($referral_id, $notification_type, "", "", "", "");
            }
        }

        // check if referral user is qualified for house bonus
        if($house=="0" && $referral_level == "exclusive"){
            // retrieve referral benchmark for house
            $query = selectPDO("select * from payout_settings where type = 'house'", array());
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $house_benchmark = $row['amount'];
            }

            $query = selectPDO("select * from referrals where sponsor_id = ?", array($referral_id));
            if($query->rowCount() == $house_benchmark){
                // credit the user with a house
                otherPDO("update accounts set house = '1' where user_id = ?", array($referral_id));

                // record bonus in payouts
                otherPDO("insert into payouts (user_id, type, date_posted) values (?,?,?)", array($referral_id, "house", $date));


                // SEND MESSAGE TO USER THAT HOUSE BONUS HAS BEEN CREDITED
                $notification_type = "house_bonus";
                sendNotification($referral_id, $notification_type, "", "", "", "");
            }
        }
    }
}

function sendNotification($user_id, $type, $bonus, $wallet_balance, $voucher_balance, $old_level){
    switch($type){
        case "register" : 
                        $query = selectPDO("select * from users where id = ?", array($user_id));
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $subject = "Thank You for Registering on Blackloop Club!";
                        $query = selectPDO("select * from page_details where name = 'after_register'", array());
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $register_email = $row['note'];
                        $register_email = preg_replace("#FNAME#", $fname, $register_email);
                        $register_email = preg_replace("#LNAME#", $lname, $register_email);
                        $message = $register_email;
                        break;
        case "welcome" : 
                        $query = selectPDO("select * from users where id = ?", array($user_id));
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $subject = "Welcome to Blackloop Club!";
                        $query = selectPDO("select * from page_details where name = 'after_payment'", array());
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $register_email = $row['note'];
                        $register_email = preg_replace("#FNAME#", $fname, $register_email);
                        $register_email = preg_replace("#LNAME#", $lname, $register_email);
                        $message = $register_email;
                        break;
        case "birthday" : 
                        $query = selectPDO("select * from users where id = ?", array($user_id));
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $subject = "HAPPY BIRTHDAY {$fname}!";
                        $query = selectPDO("select * from page_details where name = 'birthday'", array());
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $register_email = $row['note'];
                        $register_email = preg_replace("#FNAME#", $fname, $register_email);
                        $register_email = preg_replace("#LNAME#", $lname, $register_email);
                        $message = $register_email;
                        break;
        case 'level_change':
                        if($old_level<7){
                            $new_level = $old_level + 1;
                            $subject = "Congratulations! You have achieved a new level!";
                            $message = "
                            We celebrate with you as you have successfully moved from Level {$old_level} to Level {$new_level}!<br/>
                            This has earned you a bonus of N {$bonus}. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        }else{
                            $new_level="Exclusive";
                            $subject = "Congratulations! You are now an Exclusive Member!";
                            $message = "
                            We celebrate with you as you have successfully moved from Level {$old_level} to {$new_level}!<br/>
                            This has earned you a bonus of N {$bonus}. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        }
                        
                        break;
        case 'shopping_bonus':
                        $subject = "You have earned a shopping bonus of N {$bonus}!";
                        $message = "
                            We celebrate with you as you have successfully met the requirement for a shopping bonus of N {$bonus}!<br/>
                            The balance on your shopping voucher is now N {$voucher_balance}.<br/><br/>
                            Congratulations!";
                        break;
        case 'car_bonus':
                        $subject = "Congratulations! You have earned a car bonus!";
                        $message = "
                            We celebrate with you as you have successfully met the requirement for a car bonus!<br/>
                            Details on how to claim your price will be communicated to you shortly through your registered email.<br/><br/>
                            Congratulations!";
                        break;
        case 'house_bonus':
                        $subject = "Congratulations! You have earned a house bonus!";
                        $message = "
                            We celebrate with you as you have successfully met the requirement for a house bonus!<br/>
                            Details on how to claim your price will be communicated to you shortly through your registered email.<br/><br/>
                            Congratulations!";
                        break;
        case 'referral_bonus':
                        $subject = "You have earned a referral bonus of N {$bonus}!";
                        $message = "
                            We celebrate with you as you have successfully sponsored one new member to our club.<br/>
                            This has earned you a bonus of N {$bonus}. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        break;
        case 'gift':
                        $tmp = $user_id;
                        $user_id = $tmp[0];
                        $sender_id = $tmp[1];
                        $query = selectPDO("select * from users where id = ?", array($sender_id));
                        $row=$query->fetch(PDO::FETCH_ASSOC);
                        $email = $row['email'];
                        $subject = "You have received N {$bonus}!";
                        $message = "
                            {$email} sent you a sum of N {$bonus}. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        break;
        case 'bonus':
                        $subject = "You have received N {$bonus}!";
                        $message = "
                            We have rewarded you with a bonus of N {$bonus}. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        break;
        case 'refund':
                        $subject = "You have been refunded with N {$bonus}!";
                        $message = "
                            We have made a refund of N {$bonus} to you. The balance on your wallet is now N {$wallet_balance}.<br/><br/>
                            Congratulations!";
                        break;
        case 'transfer':
                        $tmp = $user_id;
                        $transfer_type = $tmp[1];
                        $user_id = $tmp[0];
                        $subject = "Your transfer request of N {$bonus} has been updated!";
                        $message = "
                            Please refer to your {$transfer_type} transfer history for details.<br/><br/>
                            Thank you!";
                        break;
        case 'ticket':
                        $tmp = $user_id;
                        $subject = $tmp[1];
                        $user_id = $tmp[0];
                        $message = "
                            The status of this ticket has been changed from active to closed since we did not get any response from you in 72hrs. If you feel this issue is still not resolved, you can click on the ticket to re-open it.<br/><br/>
                            Thank you!";
                        break;
        default : 
                        $subject = "";
                        $message = "";
    }
    $date = date("Y-m-d H:i:s");
    otherPDO("insert into notifications (user_id, subject, message, type, date_posted) values (?,?,?,?,?)", 
        array($user_id, $subject, $message, $type, $date));
}


function showUsers($sort){
    if($sort=="all"){
        $query = selectPDO("select * from users where roles is NULL order by date_activated desc", array());
    }elseif($sort=="active"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '1' order by date_activated desc", array());
    }elseif($sort=="pending"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '0' order by date_registered desc", array());
    }elseif($sort=="blocked"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '-1' order by date_activated desc", array());
    }elseif($sort=="deactivated"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '3' order by date_activated desc", array());
    }elseif($sort=="restricted"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '4' order by date_activated desc", array());
    }elseif($sort=="declined"){
        $query = selectPDO("select * from users where roles is NULL and user_status = '2' order by date_registered desc", array());
    }
    $string = "";$sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['user_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Active</span>";
        }elseif($row['user_status']=="-1"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Blocked</span>";
        }elseif($row['user_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['user_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }elseif($row['user_status']=="4"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Restricted</span>";
        }elseif($row['user_status']=="3"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Deactivated</span>";
        }
        $date = date("D, j M Y g:i a", strtotime($row['date_registered']));
        if($row['user_level']=="exclusive"){$level="Exclusive</span>";}elseif($row['user_level']=="0"){$level="-";}else{$level="{$row['user_level']}";}
        $string .= "<tr>
                        <td>{$sn}</td>
                        <td>{$row['fname']} {$row['lname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['city']}</td>
                        <td align='center'>{$status}</td>
                        <td align='center'>{$level}</td>
                        <td>{$date}</td>
                        <td align='center'>
                            <a href='user-profile?x={$row['user_code']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }

    return $string;
}

function birthdaysToday(){
    $today = date("Y-m-d");
    $query = selectPDO("select * from users where roles is NULL and user_status = '1' and birthday = ? order by date_registered desc", array($today));
    
    $string = "";$sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['user_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Active</span>";
        }elseif($row['user_status']=="-1"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Blocked</span>";
        }elseif($row['user_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['user_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }elseif($row['user_status']=="4"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Restricted</span>";
        }elseif($row['user_status']=="3"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Deactivated</span>";
        }
        $date = date("D, j M Y g:i a", strtotime($row['date_registered']));
        if($row['user_level']=="exclusive"){$level="Exclusive</span>";}elseif($row['user_level']=="0"){$level="-";}else{$level="{$row['user_level']}";}
        $string .= "<tr>
                        <td>{$sn}</td>
                        <td>{$row['fname']} {$row['lname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['city']}</td>
                        <td align='center'>{$status}</td>
                        <td align='center'>{$level}</td>
                        <td>{$date}</td>
                        <td align='center'>
                            <a href='user-profile?x={$row['user_code']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }

    return $string;
}

function allSubscribers(){
    $today = date("Y-m-d");
    $query = selectPDO("select * from email_subscribers order by date_posted desc", array($today));
    
    $string = "";$sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "<tr>
                        <td>{$sn}</td>
                        <td>{$row['fname']} {$row['lname']}</td>
                        <td>{$row['email']}</td>
                        <td>{$date}</td>
                    </tr>";
    }

    return $string;
}


function earningsHistory($user_id){
    $string = "";$sn=0;
    $query = selectPDO("select * from payouts where user_id = ? order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $type = ucfirst($row['type']);
        if($type!="Gift" && $type!="Deposit"){
            $type .= " Bonus";
        }elseif($type=="Gift"){
            $query2 = selectPDO("select * from users where id = ?", array($row['referrals_id']));
            $row2=$query2->fetch(PDO::FETCH_ASSOC);
            $type .= " ({$row2['email']})";
        }else{
            $type = "Bank Deposit";
        }
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$type}</td>
                        <td>{$row['amount']}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;
}

function walletBankHistory($user_id){
    $string = "";$sn=0;
    $query = selectPDO("select * from transfers where user_id = ? and type = 'wallet_bank' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }elseif($row['transfer_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['transfer_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['bank_name']}</td>
                        <td>{$row['acct_name']}</td>
                        <td>{$row['acct_number']}</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                        <td>{$date}</td>
                        <td>{$row['remarks']}</td>
                    </tr>";
    }
    return $string;
}

function bankVoucherHistory($user_id){
    $string = "";$sn=0;
    $query = selectPDO("select * from transfers where user_id = ? and type = 'bank_voucher' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }elseif($row['transfer_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['transfer_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $trans_date = substr(date("D, j M Y g:i a", strtotime($row['trans_date'])), 0, 16);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['bank_name']}<br/>({$row['acct_number']})</td>
                        <td>{$row['payer_name']}</td>
                        <td>{$trans_date}</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$row['remarks']}</td>
                    </tr>";
    }
    return $string;
}

function walletBankTrans(){
    $string = "";$sn=0;
    $query = selectPDO("select * from payout_settings where type = 'bank'", array());
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $transfer_charge = $row['amount'];

    $query = selectPDO("select u.email as email, u.acct_name as acct_name, u.acct_number as acct_number, u.acct_type as acct_type, u.bank_name as bank_name, u.swift_code as swift_code, t.user_id as user_id, t.amount as amount, t.transfer_status as transfer_status, t.admin as admin, t.date_posted as date_posted, t.date_modified as date_modified, t.id as id, t.remarks as remarks from transfers t inner join users u on t.user_id = u.id where t.type = 'wallet_bank' and (u.user_status = '1' or u.user_status = '4') order by t.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }elseif($row['transfer_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['transfer_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        $query2 = selectPDO("select * from accounts where user_id = ?", array($row['user_id']));
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $wallet_bal = $row2['wallet_bal'];
        $charge = $transfer_charge * $row['amount'] / 100;
        $total = $row['amount']+$charge;
        $new_bal = $wallet_bal - $total;
        if($total>$wallet_bal){$allow="disabled";$allow_note="style='color:red;'";}else{$allow="";$allow_note="";}
        if($row['transfer_status']=="0"){
            $submit = "<button type='submit' onclick='return checkStatus({$row['id']});' name='update_transfer' class='btn btn-success'>Save changes</button>";
            $signature = "";
        }else{
            $submit="";
            $query2=selectPDO("select * from users where id = ?", array($row['admin']));
            $row2=$query2->fetch(PDO::FETCH_ASSOC);
            $admin = $row2['email'];
            $signature = "<div class='form-group text-center'>
                            <p>Approved by: {$admin}</p>
                        </div>";
        }
        $total = number_format($total, 2);
        $amount = number_format(floatval($row['amount']), 2);
        $charge = number_format($charge, 2);
        $wallet_bal = number_format($wallet_bal, 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['acct_number']}</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#manageTransfer{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='manageTransfer{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Manage Request</h1>
                                        </div>

                                        <div class='modal-body'>
                                            <input type='text' name='transfer_id' value='{$row['id']}' style='display:none;' />
                                            <input type='text' name='new_bal' value='{$new_bal}' style='display:none;' />
                                            <input type='text' name='user_id' value='{$row['user_id']}' style='display:none;' />
                                            <input type='text' name='request_amt' value='{$amount}' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Request Amount:</div>
                                                <div class='col-xs-7'>&#8358; {$amount}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Trans. Fee:</div>
                                                <div class='col-xs-7'>&#8358; {$charge}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Total:</div>
                                                <div class='col-xs-7'>&#8358; {$total}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Wallet Bal:</div>
                                                <div class='col-xs-7' {$allow_note}>&#8358; {$wallet_bal}</div>
                                            </div>

                                            <br/><br/><br/><hr/>
                                            
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Bank Name:</div>
                                                <div class='col-xs-7'>{$row['bank_name']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Account Name:</div>
                                                <div class='col-xs-7'>{$row['acct_name']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Account No:</div>
                                                <div class='col-xs-7'>{$row['acct_number']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Account Type:</div>
                                                <div class='col-xs-7'>{$row['acct_type']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Swift Code:</div>
                                                <div class='col-xs-7'>{$row['swift_code']}</div>
                                            </div>

                                            <br/><br/><br/><br/><br/><hr/>

                                            <div class='form-group'>
                                                <label>Select Status</label>
                                                <select name='status' id='status{$row['id']}' class='form-control'>
                                                    <option "; if($row['transfer_status']=="0"){$string.="selected";} $string.=" value='0'>Pending</option>
                                                    <option "; if($row['transfer_status']=="1"){$string.="selected";} $string.=" value='1' {$allow}>Approved</option>
                                                    <option "; if($row['transfer_status']=="2"){$string.="selected";} $string.=" value='2'>Declined</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Remarks, if declined</label>
                                                <textarea name='remarks' id='remarks{$row['id']}' class='form-control'>{$row['remarks']}</textarea>
                                            </div>
                                            {$signature}
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            {$submit}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}

function bankVoucherTrans(){
    $string = "";$sn=0;
    $query = selectPDO("select * from payout_settings where type = 'to_voucher'", array());
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $transfer_charge = $row['amount'];

    $query = selectPDO("select u.email as email, t.user_id as user_id, t.acct_name as acct_name, t.acct_number as acct_number, t.trans_date as trans_date, t.bank_name as bank_name, t.payer_name as payer_name, t.amount as amount, t.transfer_status as transfer_status, t.admin as admin, t.date_posted as date_posted, t.date_modified as date_modified, t.id as id, t.remarks as remarks from transfers t inner join users u on t.user_id = u.id where t.type = 'bank_voucher' and u.user_status = '1' order by t.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }elseif($row['transfer_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['transfer_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        $trans_date = substr(date("D, j M Y g:i a", strtotime($row['trans_date'])), 0, 16);
        $query2 = selectPDO("select * from accounts where user_id = ?", array($row['user_id']));
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $voucher_bal = $row2['voucher_bal'];
        $charge = $transfer_charge * $row['amount'] / 100;
        $total = $row['amount']-$charge;
        $new_bal = $voucher_bal + $total;
        if($row['transfer_status']=="0"){
            $submit = "<button type='submit' onclick='return checkStatus({$row['id']});' name='update_transfer' class='btn btn-success'>Save changes</button>";
            $signature = "";
        }else{
            $submit="";
            $query2=selectPDO("select * from users where id = ?", array($row['admin']));
            $row2=$query2->fetch(PDO::FETCH_ASSOC);
            $admin = $row2['email'];
            $signature = "<div class='form-group text-center'>
                            <p>Approved by: {$admin}</p>
                        </div>";
        }
        $amount2 = $total;
        $total = number_format($total, 2);
        $amount = number_format(floatval($row['amount']), 2);
        $charge = number_format($charge, 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['bank_name']}<br/>({$row['acct_number']})</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#manageTransfer{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='manageTransfer{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Manage Request</h1>
                                        </div>

                                        <div class='modal-body'>
                                            <input type='text' name='transfer_id' value='{$row['id']}' style='display:none;' />
                                            <input type='text' name='new_bal' value='{$new_bal}' style='display:none;' />
                                            <input type='text' name='user_id' value='{$row['user_id']}' style='display:none;' />
                                            <input type='text' name='request_amt' value='{$amount}' style='display:none;' />
                                            <input type='text' name='request_amt2' value='{$amount2}' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Payer Name:</div>
                                                <div class='col-xs-7'>{$row['payer_name']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Trans. Date:</div>
                                                <div class='col-xs-7'>{$trans_date}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Request Amount:</div>
                                                <div class='col-xs-7'>&#8358; {$amount}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Trans. Fee:</div>
                                                <div class='col-xs-7'>&#8358; {$charge}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>New Total:</div>
                                                <div class='col-xs-7'>&#8358; {$total}</div>
                                            </div>
                                            

                                            <br/><br/><br/><br/><hr/>
                                            
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Bank Name:</div>
                                                <div class='col-xs-7'>{$row['bank_name']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Account Name:</div>
                                                <div class='col-xs-7'>{$row['acct_name']}</div>
                                            </div>
                                            <div class='form-group'>
                                                <div class='col-xs-5'>Account No:</div>
                                                <div class='col-xs-7'>{$row['acct_number']}</div>
                                            </div>

                                            <br/><br/><br/><hr/>

                                            <div class='form-group'>
                                                <label>Select Status</label>
                                                <select name='status' id='status{$row['id']}' class='form-control'>
                                                    <option "; if($row['transfer_status']=="0"){$string.="selected";} $string.=" value='0'>Pending</option>
                                                    <option "; if($row['transfer_status']=="1"){$string.="selected";} $string.=" value='1'>Approved</option>
                                                    <option "; if($row['transfer_status']=="2"){$string.="selected";} $string.=" value='2'>Declined</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Remarks, if declined</label>
                                                <textarea name='remarks' id='remarks{$row['id']}' class='form-control'>{$row['remarks']}</textarea>
                                            </div>
                                            {$signature}
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            {$submit}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}

function walletVoucherHistory($user_id){
    $string = "";$sn=0;
    $query = selectPDO("select * from transfers where user_id = ? and type = 'wallet_voucher' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$date}</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                    </tr>";
    }
    return $string;
}

function walletUserHistory($user_id){
    $string = "";$sn=0;
    $query = selectPDO("select * from transfers where user_id = ? and type = 'wallet_user' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['transfer_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Approved</span>";
        }
        $query2 = selectPDO("select * from users where id = ?", array($row['beneficiary_id']));
        $row2 = $query2->fetch(PDO::FETCH_ASSOC);
        $beneficiary_email = $row2['email'];
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$beneficiary_email}</td>
                        <td>&#8358; {$row['amount']}</td>
                        <td>{$status}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;
}


function getNotifications($user_id, $limit, $perpage){
    $string = "";
    $query = selectPDO("select * from notifications where user_id = ? order by date_posted desc", array($user_id));
    $all = $query->rowCount();
    $query = selectPDO("select * from notifications where user_id = ? order by date_posted desc limit 20", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $brief = substr(strip_tags($row['message']), 0, 100);
        $brief .= "...";
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date = substr($date_posted, 0, 16);
        $time = substr($date_posted, -7);
        if($row['read_status']==0){$read_class="";}else{$read_class="unread";}
        $string .= "
                    <div class='col-xs-12'>
                        <div class='i-check col-xs-1 mark_read' for='{$row['id']}'>
                            <input tabindex='9' style='margin-top: 20px;' type='checkbox' id='{$row['id']}'>
                        </div>
                        <a href='#' onclick='markRead({$row['id']});' id='notice{$row['id']}' class='md-trigger col-xs-11 inbox_item {$read_class}' data-toggle='modal' data-target='#Modal{$row['id']}'>
                            <div class='inbox-avatar'>
                                
                                <div class='inbox-avatar-text'>
                                    <div class='avatar-name'>{$row['subject']}</div>
                                    <div><small><span>{$brief}</span></small></div>
                                </div>
                                <div class='inbox-date hidden-sm hidden-xs hidden-md'>
                                    <div class='date'>{$time}</div>
                                    <div><small>{$date}</small></div>
                                </div>
                            </div>
                        </a>

                        <div class='modal fade' id='Modal{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <h3>{$row['subject']}</h3>
                                </div>
                                        <div class='modal-body'>
                                    <p>{$row['message']}</p>
                                </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>";

    }
    return array($string, $all);
}


function notifications($user_id){
    $string = "";
    $query = selectPDO("select * from notifications where user_id = ? and read_status = '0' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $brief = substr(strip_tags($row['message']), 0, 82);
        $brief .= "...";
        $string .= "
                    <li>
                        <a class='rad-content' href='#' style='padding-left:0px;cursor:text;'>
                            <div class='rad-notification-body'>
                                <div class='lg-text'>{$row['subject']}</div>
                                <div class='sm-text'>{$brief}</div>
                            </div>
                        </a>
                    </li>";

    }
    $size = $query->rowCount();
    return array($string, $size);
}


function getUpdates($user_id, $last_online, $next_online, $news_read){
    $string = "";
    $query = selectPDO("select * from news_updates where status = '1' order by date_posted desc limit 20", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $brief = substr(strip_tags($row['message']), 0, 100);
        $brief .= "...";
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date = substr($date_posted, 0, 16);
        $time = substr($date_posted, -7);
        $tags_all = $row['tags'];
        $tags = explode(",", $tags_all);
        $tag = "";
        if(sizeof($tags)>0){
            foreach ($tags as $key => $value) {
                $query2 = selectPDO("select * from news_tags where id = ?", array($value));
                while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
                    $name = strtoupper($row2['name']);
                    $tag .= "<span class='label label-pill label-{$row2['color']} m-r-5'>{$name}</span>";
                }
            }
        }
        if((($row['date_posted']>=$last_online) && $news_read<$next_online) || ($last_online==null && $news_read==null)){$read_class="";}else{$read_class="unread";}
        $string .= "<a href='news-item?v={$row['id']}' class='inbox_item {$read_class}'>
                        <div class='inbox-avatar'>
                            <div class='inbox-avatar-text'>
                                <div class='avatar-name'>{$row['subject']}</div>
                                <div><small><span>{$brief}</span></small></div>
                                {$tag}
                            </div>
                            <div class='inbox-date hidden-sm hidden-xs hidden-md'>
                                <div class='date'>{$time}</div>
                                <div><small>{$date}</small></div>
                            </div>
                        </div>
                    </a>";

    }
    otherPDO("update users set news_read = ? where id = ?", array(date("Y-m-d H:i:s"), $user_id));
    return $string;
}


function newTickets($user_id){
    $string = "";
    $query = selectPDO("select * from tickets where user_id = ? and read_status = '0' order by date_posted desc", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $brief = substr(strip_tags($row['message']), 0, 82);
        $brief .= "...";
        $string .= "
                    <li>
                        <a class='rad-content' href='#' style='padding-left:0px;cursor:text;'>
                            <div class='rad-notification-body'>
                                <div class='lg-text'>{$row['subject']}</div>
                                <div class='sm-text'>{$brief}</div>
                            </div>
                        </a>
                    </li>";

    }
    $size = $query->rowCount();
    return array($string, $size);
}

function newTicketsAdmin(){
    $query = selectPDO("select * from tickets where ticket_status = '1' and user_id is not NULL", array());
    $string="";$count = 0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $query2 = selectPDO("select * from tickets where parent = ? and admin is NULL order by date_posted desc", array($row['id']));
        $count++;
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $brief = substr(strip_tags($row2['message']), 0, 82);
        $brief .= "...";
        $string .= "
                    <li>
                        <a class='rad-content' href='#' style='padding-left:0px;cursor:text;'>
                            <div class='rad-notification-body'>
                                <div class='lg-text'>{$row['subject']}</div>
                                <div class='sm-text'>{$brief}</div>
                            </div>
                        </a>
                    </li>";

    }
    return array($string, $count);
}

function transferRequests(){
    $count = 0; $bank = 0; $voucher = 0;
    $query = selectPDO("select * from transfers where type = 'wallet_bank' and transfer_status = '0'", array());
    $bank = $query->rowCount();
    $query = selectPDO("select * from transfers where type = 'bank_voucher' and transfer_status = '0'", array());
    $voucher = $query->rowCount();
    $count = $bank + $voucher;
    $string = "
                <li>
                    <a class='rad-content' href='wallet-bank' style='padding-left:0px;'>
                        <div class='rad-notification-body'>
                            <div class='lg-text'>Wallet to Bank <span style='font-weight:normal'> -> {$bank}</span></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class='rad-content' href='bank-voucher' style='padding-left:0px;'>
                        <div class='rad-notification-body'>
                            <div class='lg-text'>Bank to Voucher <span style='font-weight:normal'> -> {$voucher}</span></div>
                        </div>
                    </a>
                </li>";

    return array($string, $count);
}


function getDownloads(){
    $string = "";
    $query = selectPDO("select * from multimedia where type = 'image' and status = '1' order by date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <div class='col-xs-12 col-sm-6 col-md-4'>
                            <div class='profile-widget'>
                                <div class='panel panel-bd'>
                                    <div class='panel-heading' style='background-image: url(\"../{$row['cover_photo']}\"); width:100%;'> </div>
                                    <div class='panel-body'>
                                        <div class='media text-center'>
                                            <div class='media-body'>
                                                <h2 class='media-heading'>{$row['title']}</h2>
                                                {$date_posted}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='panel-footer'>
                                        <div class='btn-group btn-group-justified'>
                                            <a class='btn btn-default' onclick='downloadFile(\"../{$row['url']}\")' role='button'><i class='fa fa-download'></i> Download Now</a></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    return $string;
}

function getVideos(){
    $string = "";
    $query = selectPDO("select * from multimedia where type = 'video' and status = '1' order by date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $string .= "
                    <div class='col-xs-12 col-sm-6'>
                            <div class='profile-widget'>
                                <div class='panel panel-bd'>
                                    <div class='panel-heading' style='background:#2c3136'>
                                    <iframe width='100%' height='200px' src='{$row['url']}' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>
                                    </div>
                                    <div class='panel-body'>
                                        <div class='media text-center'>
                                            <div class='media-body'>
                                                <h2 class='media-heading'>{$row['title']}</h2>
                                                {$date_posted}
                                            </div>
                                        </div>
                                    </div>
                                    <div class='panel-footer'>
                                    </div>
                                </div>
                            </div>
                        </div>";
    }

    return $string;
}

function showVideos(){
    $string = "";
    $query = selectPDO("select u.email as email, m.title as title, m.url as url, m.status as status, m.admin as admin, m.date_posted as date_posted, m.date_modified as date_modified, m.id as id from multimedia m inner join users u on m.admin = u.id where m.type = 'video' order by m.date_posted desc", array());
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        if($row['status']==0){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Disabled</span>";
        }else{
            $status="<span class='label label-pill label-success-outline m-r-15'>Enabled</span>";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['url']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editVideo{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editVideo{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Edit Video</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type='text' value='{$row['id']}' name='video_id' style='display:none;' />
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Video Title</label>
                                                <input type='text' required value='{$row['title']}' name='title' placeholder='Enter video title' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Video URL</label>
                                                <input type='text' value='{$row['url']}' name='url' placeholder='Enter video URL' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Change Status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['status']==1){ $string .= "selected";}  
                                                        $string .= " value='1'>Enabled</option>
                                                    <option "; 
                                                    if($row['status']==0){ $string .= "selected";}  
                                                        $string .= " value='0'>Disabled</option>
                                                    <option>Delete</option>
                                                </select>
                                            </div>
                                            <div class='form-group text-center'>
                                                <p>Uploaded by: {$row['email']}</p>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_video' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}

function showDownloads(){
    $string = "";
    $query = selectPDO("select u.email as email, m.cover_photo as cover, m.title as title, m.url as url, m.status as status, m.admin as admin, m.date_posted as date_posted, m.date_modified as date_modified, m.id as id from multimedia m inner join users u on m.admin = u.id where m.type = 'image' order by m.date_posted desc", array());
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        if($row['status']==0){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Disabled</span>";
        }else{
            $status="<span class='label label-pill label-success-outline m-r-15'>Enabled</span>";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td><img src='../../{$row['cover']}' width='80px' /></td>
                        <td>{$row['title']}</td>
                        <td>{$row['url']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editDownload{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editDownload{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post' enctype='multipart/form-data'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Edit Download</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type='text' value='{$row['id']}' name='download_id' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Current Cover</label>
                                                <img src='../../{$row['cover']}' width='100%' style='max-width:200px;' />
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Choose New Cover (1024px by 640px) 5mb Max</label>
                                                <input type='file' name='cover' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Download Title</label>
                                                <input type='text' required value='{$row['title']}' name='title' placeholder='Enter download title' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Current File URL</label>
                                                <input type='text' required value='{$row['url']}' readonly  class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Upload New File (5mb Max)</label>
                                                <input type='file' name='url' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Change Status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['status']==1){ $string .= "selected";}  
                                                        $string .= " value='1'>Enabled</option>
                                                    <option "; 
                                                    if($row['status']==0){ $string .= "selected";}  
                                                        $string .= " value='0'>Disabled</option>
                                                    <option>Delete</option>
                                                </select>
                                            </div>
                                            <div class='form-group text-center'>
                                                <p>Uploaded by: {$row['email']}</p>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_download' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}

function showUpdates(){
    $string = "";
    $query = selectPDO("select u.email as email, n.banner as banner, n.subject as subject, n.tags as tags, n.status as status, n.admin as admin, n.message as message, n.date_posted as date_posted, n.last_modified as last_modified, n.id as id from news_updates n inner join users u on n.admin = u.id order by n.date_posted desc", array());
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $last_modified = date("D, j M Y g:i a", strtotime($row['last_modified']));
        if($row['banner']!=NULL){
                $banner = "<img src='../../{$row['banner']}' width='80px' />";
                $current_banner = "<img src='../../{$row['banner']}' width='100%' style='max-width:200px;' />";
            }else{
                $banner = "";
                $current_banner = "<br/>N/a";
            }
        if($row['status']==0){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Draft</span>";
        }else{
            $status="<span class='label label-pill label-success-outline m-r-15'>Published</span>";
        }
        $tags_all = $row['tags'];
        $tags = explode(",", $tags_all);
        $tag = "";
        foreach ($tags as $key => $value) {
            $query2 = selectPDO("select * from news_tags where id = ?", array($value));
            while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
                $name = strtoupper($row2['name']);
                $tag .= "<span class='label label-pill label-{$row2['color']} m-r-5'>{$name}</span> ";
            }
        }
        $tagging = "";
        $query2 = selectPDO("select * from news_tags", array());
        while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
            $tagging .= "<br/><label><input type='checkbox' name='tags[]' ";
            foreach ($tags as $key => $value) {
                if($value==$row2['id']){
                    $tagging .= "checked";
                }
            }
            $tagging .=" value='{$row2['id']}' /> {$row2['name']}</label>";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$banner}</td>
                        <td>{$row['subject']}</td>
                        <td>{$tag}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$last_modified}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editDownload{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editDownload{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post' enctype='multipart/form-data'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Edit Update</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type='text' id='update_id' value='{$row['id']}' name='update_id' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Current Banner</label>
                                                {$current_banner}
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Choose New Banner (1400px by 600px) 5mb Max</label>
                                                <input type='file' name='banner' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Subject</label>
                                                <input type='text' required value='{$row['subject']}' name='subject' placeholder='Enter subject for news item' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>News Tags</label>
                                                {$tagging}
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Message</label>
                                                <textarea required='' id='summernote{$row['id']}' name='message'>{$row['message']}</textarea>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Change Status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['status']==1){ $string .= "selected";}  
                                                        $string .= " value='1'>Published</option>
                                                    <option "; 
                                                    if($row['status']==0){ $string .= "selected";}  
                                                        $string .= " value='0'>Draft</option>
                                                    <option>Delete</option>
                                                </select>
                                            </div>
                                            <div class='form-group text-center'>
                                                <p>Uploaded by: {$row['email']}</p>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_news' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";

    }
    return $string;
}

function allBankAccounts(){
    $string = "";$sn=0;
    $query = selectPDO("select * from bank_accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['bank_name']}</td>
                        <td>{$row['acct_name']}</td>
                        <td>{$row['acct_number']}</td>
                        <td>{$row['acct_type']}</td>
                        <td>{$row['swift_code']}</td>
                        <td align='center'>
                            <a href='?del={$row['id']}'><button class='btn btn-danger btn-sm' type='button' onclick='return confirm(\"Delete entry?\")' title='Delete'><i class='fa fa-times' ></i></button></a>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editBank{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editBank{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post' enctype='multipart/form-data'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Edit Bank Details</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type='text' value='{$row['id']}' name='bank_id' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Bank Name</label>
                                                <input type='text' required value='{$row['bank_name']}' name='bank_name' placeholder='Enter bank name' class='form-control'>
                                            </div>

                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account Name</label>
                                                <input type='text' required value='{$row['acct_name']}' name='acct_name' placeholder='Enter account name' class='form-control'>
                                            </div>

                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account Number</label>
                                                <input type='number' required value='{$row['acct_number']}' name='acct_number' placeholder='Enter account number' class='form-control'>
                                            </div>
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account Type</label>
                                                <select name='acct_type' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['acct_type']=='Current'){ $string .= "selected";}  
                                                        $string .= " value='1'>Current</option>
                                                    <option "; 
                                                    if($row['acct_type']=='Savings'){ $string .= "selected";}  
                                                        $string .= " value='0'>Savings</option>
                                                    <option "; 
                                                    if($row['acct_type']=='Dollar'){ $string .= "selected";}  
                                                        $string .= " value='0'>Dollar</option>
                                                </select>
                                            </div>
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Swift Code</label>
                                                <input type='text' value='{$row['swift_code']}' name='swift_code' placeholder='Enter swift code' class='form-control'>
                                            </div>

                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Transaction PIN</label>
                                                <input required type='password' autocomplete='new-password' name='fakepasswordremembered' placeholder='Enter transactin PIN' class='form-control'>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_account' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}

function allNewsTags(){
    $string = "";$sn=0;
    $query = selectPDO("select * from news_tags", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $color = ucfirst($row['color']);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['name']}</td>
                        <td>{$color}</td>
                        <td align='center'>
                            <a href='?del={$row['id']}'><button class='btn btn-danger btn-sm' type='button' onclick='return confirm(\"Delete entry?\")' title='Delete'><i class='fa fa-times' ></i></button></a>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editTag{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editTag{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post' enctype='multipart/form-data'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Edit News Tag</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type='text' value='{$row['id']}' name='tag_id' style='display:none;' />
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Tag Name</label>
                                                <input type='text' required value='{$row['name']}' name='name' placeholder='Enter tag name' class='form-control'>
                                            </div>

                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Color</label>
                                                <select name='color' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['color']=='default'){ $string .= "selected";}  
                                                        $string .= " value='default'>Default (Grey)</option>
                                                    <option "; 
                                                    if($row['color']=='primary'){ $string .= "selected";}  
                                                        $string .= " value='primary'>Primary (Blue)</option>
                                                    <option "; 
                                                    if($row['color']=='success'){ $string .= "selected";}  
                                                        $string .= " value='success'>Success (Green)</option>
                                                    <option "; 
                                                    if($row['color']=='info'){ $string .= "selected";}  
                                                        $string .= " value='info'>Info (Light-blue)</option>
                                                    <option "; 
                                                    if($row['color']=='warning'){ $string .= "selected";}  
                                                        $string .= " value='warning'>Warning (Yellow)</option>
                                                    <option "; 
                                                    if($row['color']=='danger'){ $string .= "selected";}  
                                                        $string .= " value='danger'>Danger (Red)</option>
                                                </select>
                                            </div>
                                            
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Transaction PIN</label>
                                                <input required type='password' autocomplete='new-password' name='fakepasswordremembered' placeholder='Enter transactin PIN' class='form-control'>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_tag' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }
    return $string;
}


function activeTickets($user_id){
    $string = "";
    $query = selectPDO("select * from tickets where user_id = ? and ticket_status = '1' order by date_posted desc", array($user_id));
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $query2 = selectPDO("select * from tickets where parent = ? order by date_posted desc", array($row['id']));
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $count = $query2->rowCount();
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row2['date_posted']));
        if(substr($row['subject'], 35)!=""){
            $subject = substr($row['subject'], 0, 35);
            $subject .= "...";
        }else{
            $subject = $row['subject'];
        }
        if($row['read_status']==0){
            $read = "<span class='fa fa-circle' title='Unread' style='color:green;'></span>";
        }else{
            $read = "";
        }
        if($row2['admin']==NULL){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }else{
            $status="<span class='label label-pill label-success-outline m-r-15'>Answered</span>";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$read} {$subject} ({$count})</td>
                        <td>{$row['type']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <a href='?x={$row['id']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }
    return $string;
}

function allActiveTickets(){
    $string = "";
    $query = selectPDO("select u.email as email, t.id as id, t.date_posted as date_posted, t.date_posted as date_posted, t.subject as subject, t.type as type, t.flag as flag from tickets t inner join users u on t.user_id = u.id where t.ticket_status = '1' order by t.date_posted desc", array());
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $query2 = selectPDO("select * from tickets where parent = ? order by date_posted desc", array($row['id']));
        $count = $query2->rowCount();
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row2['date_posted']));
        if(substr($row['subject'], 35)!=""){
            $subject = substr($row['subject'], 0, 35);
            $subject .= "...";
        }else{
            $subject = $row['subject'];
        }
        if($row2['admin']==NULL){
            $read = "<span class='fa fa-circle' title='Unanswered' style='color:green;'></span>";
        }else{
            $read = "";
        }
        if($row['flag']=="1"){
            $flags = "<span class='fa fa-flag' title='Flagged for further action'></span>";
        }else{
            $flags = "";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$read} {$row['email']}</td>
                        <td>{$subject} ({$count})</td>
                        <td align='center'>{$flags}</td>
                        <td>{$row['type']}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <a href='?x={$row['id']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }
    return $string;
}

function closedTickets($user_id){
    $string = "";
    $query = selectPDO("select * from tickets where user_id = ? and ticket_status = '2' order by date_posted desc", array($user_id));
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $query2 = selectPDO("select * from tickets where parent = ? order by date_posted desc", array($row['id']));
        $count = $query2->rowCount();
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row2['date_posted']));
        if(substr($row['subject'], 35)!=""){
            $subject = substr($row['subject'], 0, 35);
            $subject .= "...";
        }else{
            $subject = $row['subject'];
        }
        if($row['read_status']==0){
            $read = "<span class='fa fa-circle' title='Unread' style='color:green;'></span>";
        }else{
            $read = "";
        }
        if($row2['admin']==NULL){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }else{
            $status="<span class='label label-pill label-success-outline m-r-15'>Answered</span>";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$read} {$subject} ({$count})</td>
                        <td>{$row['type']}</td>
                        <td>{$status}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <a href='?x={$row['id']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }
    return $string;
}

function allClosedTickets(){
    $string = "";
    $query = selectPDO("select u.email as email, t.id as id, t.date_posted as date_posted, t.date_posted as date_posted, t.subject as subject, t.type as type from tickets t inner join users u on t.user_id = u.id where t.ticket_status = '2' order by t.date_posted desc", array());
    $sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $query2 = selectPDO("select * from tickets where parent = ? order by date_posted desc", array($row['id']));
        $count = $query2->rowCount();
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row2['date_posted']));
        if(substr($row['subject'], 35)!=""){
            $subject = substr($row['subject'], 0, 35);
            $subject .= "...";
        }else{
            $subject = $row['subject'];
        }
        if($row2['admin']==NULL){
            $read = "<span class='fa fa-circle' title='Unanswered' style='color:green;'></span>";
        }else{
            $read = "";
        }
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$read} {$row['email']}</td>
                        <td>{$subject} ({$count})</td>
                        <td>{$row['type']}</td>
                        <td>{$date_posted}</td>
                        <td>{$date_modified}</td>
                        <td align='center'>
                            <a href='?x={$row['id']}'><button class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='left' title='View'><i class='fa fa-eye' aria-hidden='true'></i></button></a>
                        </td>
                    </tr>";
    }
    return $string;
}

function totalLevel($level){
    $query = selectPDO("select * from users where user_level = ? and user_status = '1' and roles is NULL", array($level));
    $count = $query->rowCount();

    return $count;
}

function totalActive(){
    $query = selectPDO("select * from users where user_status = '1' and roles is NULL", array());
    $count = $query->rowCount();

    return $count;
}

function totalPending(){
    $query = selectPDO("select u.id from users u inner join payments p on u.id = p.user_id where p.payment_status = '0' and u.user_status = '0' and u.roles is NULL and p.type <> 'card'", array());
    $count = $query->rowCount();

    return $count;
}

function totalAdmin(){
    $query = selectPDO("select * from users where roles is not NULL", array());
    $count = $query->rowCount();

    return $count;
}

function totalEarnings(){ // all monies ever received in the system from the beginning
    $amount = totalPayments() + totalDeposits();

    return $amount;
}

function totalPayments(){ // all monies ever received in the system through payment for membership plans
    $amount = 0;
    $query = selectPDO("select * from payments where payment_status = '1'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $amount+=$row['amount'];
    }

    return $amount;
}

function cummOutflow(){
    $amount = totalPayouts() + outstandingPayouts() + totalRefunds();
    return $amount;
}

function totalPayouts(){ // all monies taken out of the system by clients
    $amount = totalBankCashouts() + totalPurchases() + totalAssetCashouts() + totalRefunds();
    return $amount;
}

function outstandingPayouts(){ // all monies in the system due to clients
    $amount = 0;
    $amount += outstandingWallet() + outstandingVoucher() + outstandingCar() + outstandingHouse();
    return $amount;
}

function outstandingWallet(){
    $total_wallet = 0;
    $query = selectPDO("select * from accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $total_wallet += $row['wallet_bal'];
    }

    return $total_wallet;
}

function outstandingVoucher(){
    $total_voucher = 0;
    $query = selectPDO("select * from accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $total_voucher += $row['voucher_bal'];
    }

    return $total_voucher;
}

function outstandingCar(){
    $total_car = 0; $car = 0;
    $query = selectPDO("select * from value_chart where name = 'car'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $car = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select * from accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $total_car = $total_car + ($car * $row['car']);
    }

    return $total_car;
}

function outstandingHouse(){
    $total_house = 0; $house = 0;
    $query = selectPDO("select * from value_chart where name = 'house'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $house = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select * from accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $total_house = $total_house + ($house * $row['house']);
    }

    return $total_house;
}

function totalCompanyCashouts(){ // all monies withdrawn by the company for personal use
    $cashouts = totalSelfWithdrawals() + totalOtherPartyWithdrawals();
    return $cashouts;
}

function totalSelfWithdrawals(){ // all monies withdrawn by the company for personal use
    $cashouts = 0;
    $query = selectPDO("select * from withdrawals where beneficiary = 'Self'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $cashouts += $row['amount'];
    }

    return $cashouts;
}

function totalOtherPartyWithdrawals(){ // all monies withdrawn by the company for third party
    $cashouts = 0;
    $query = selectPDO("select * from withdrawals where beneficiary <> 'Self'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $cashouts += $row['amount'];
    }

    return $cashouts;
}

function currentEarnings(){ // all monies in the system jointly owned by the company and clients
    $amount = totalEarnings() - (totalCompanyCashouts() + totalPayouts());
    return $amount;
}

function grossEarnings(){ // all monies in the system ever owned by the company, including amounts withdrawn in the past
    $amount = totalEarnings() - (totalPayouts() + outstandingPayouts());
    return $amount;
}

function netEarnings(){ // all monies in the system owned by only the company
    $amount = grossEarnings() - totalCompanyCashouts();
    return $amount;
}

function totalBankCashouts(){ // all monies taken out of the system by clients through the bank
    $cashouts = 0;
    $query = selectPDO("select * from transfers where type = 'wallet_bank' and transfer_status = '1'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $cashouts += $row['amount'];
    }

    return $cashouts;
}

function totalPurchases(){ // all monies taken out of the system by clients through bank transfers
    $purchases = 0;
    $query = selectPDO("select * from purchases", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $purchases += $row['amount'];
    }

    return $purchases; 
}

function totalAssetCashouts(){ // all assets in monetary value taken out of the system by clients
    $amount = 0;
    $query = selectPDO("select * from value_chart where name = 'car'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $car = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select * from value_chart where name = 'house'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $house = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select * from accounts", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $amount+= ($row['car_out'] * $car) + ($row['house_out'] * $house);
    }
    return $amount;
}

function totalDeposits(){ // all monies ever received in the system through bank to voucher transactions
    $deposits = 0;
    $query = selectPDO("select * from bank_inflow", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $deposits += $row['amount'];
    }

    return $deposits; 
}

function totalRefunds(){ // all monies refunded to clients for whatever reasons
    $refunds = 0;
    $query = selectPDO("select * from payouts where type = 'refund'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $refunds += $row['amount'];
    }

    return $refunds; 
}

function membershipPurchaseHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, p.user_type as plan, p.type as method, p.amount as amount, p.date_modified as date_processed from payments p inner join users u on p.user_id = u.id where p.payment_status = '1' order by p.date_modified desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $plan = ucfirst($row['plan']);
        $method = ucfirst($row['method']);
        $date = date("D, j M Y g:i a", strtotime($row['date_processed']));
        $amount = number_format(floatval($row['amount']), 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>{$plan}</td>
                        <td>{$method}</td>
                        <td>&#8358; {$amount}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;
}

function bankDepositHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, b.amount as amount, b.date_posted as date_posted from bank_inflow b inner join users u on b.user_id = u.id order by b.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $email = $row['email'];
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $amount = number_format(floatval($row['amount']), 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$email}</td>
                        <td>&#8358; {$amount}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;   
}

function onlinePaymentHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, o.transaction_id as trans_id, o.merchant_ref as merchant_ref, o.total as total_paid, o.total_credited_to_merchant as total_credited, o.elect_method as gateway, o.transaction_status as status, o.transaction_date as trans_date from online_transactions o inner join users u on o.user_id = u.id order by o.transaction_date desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($row['trans_date']));
        $total_paid = number_format($row['total_paid'], 2);
        $total_credited = number_format($row['total_credited'], 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['trans_id']}</td>
                        <td>{$row['merchant_ref']}</td>
                        <td>&#8358; {$total_paid}</td>
                        <td>&#8358; {$total_credited}</td>
                        <td>{$row['gateway']}</td>
                        <td>{$row['status']}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;   
}

function totalPayoutHistory(){
    $string = "";
    $email = array();
    $type = array();
    $amount = array();
    $date = array();

    // wallet to bank
    $query = selectPDO("select u.email as email, t.amount as amount, t.date_modified as date_modified from transfers t inner join users u on t.user_id = u.id where t.type = 'wallet_bank' and t.transfer_status = '1'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Bank";
        $amount[] = $row['amount'];
        $date[] = $row['date_modified'];
    }

    // shopping
    $query = selectPDO("select * from purchases", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $type[] = "Purchases";
        $amount[] = $row['amount'];
        $date[] = $row['date_posted'];
        $query2 = selectPDO("select u.email as email from shopping_transactions s inner join users u on s.user_id = u.id where s.id = ?", array($row['transaction_id']));
        while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
            $email[] = $row2['email'];
        }
    }

    // refunds
    $query = selectPDO("select u.email as email, p.amount as amount, p.date_posted as date_posted from payouts p inner join users u on p.user_id = u.id where p.type = 'refund'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Refund";
        $amount[] = $row['amount'];
        $date[] = $row['date_posted'];
    }

    // car
    $query = selectPDO("select * from value_chart where name = 'car'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $car = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select u.email as email, a.car_out as car_out, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id where a.car_out <> 0", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Car";
        $amount[] = $row['car_out'] * $car;
        $date[] = $row['date_modified'];
    }

    // house
    $query = selectPDO("select * from value_chart where name = 'house'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $house = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select u.email as email, a.house_out as house_out, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id where a.house_out <> 0", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "House";
        $amount[] = $row['house_out'] * $house;
        $date[] = $row['date_modified'];
    }

    array_multisort($date,SORT_DESC,$type,$amount, $email);
    $sn = 0;
    for($i=0; $i<sizeof($date); $i++){
        $sn++;
        $date_posted = date("D, j M Y g:i a", strtotime($date[$i]));
        $amnt = number_format($amount[$i]);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$email[$i]}</td>
                        <td>{$type[$i]}</td>
                        <td>&#8358; {$amnt}</td>
                        <td>{$date_posted}</td>
                    </tr>";
    }

    return $string;   
}

function totalOutstandingHistory(){
    $string = "";
    $email = array();
    $type = array();
    $amount = array();
    $date = array();

    // wallet
    $query = selectPDO("select u.email as email, a.wallet_bal as wallet_bal, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Wallet";
        $amount[] = $row['wallet_bal'];
        $date[] = $row['date_modified'];
    }

    // voucher
    $query = selectPDO("select u.email as email, a.voucher_bal as voucher_bal, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Voucher";
        $amount[] = $row['voucher_bal'];
        $date[] = $row['date_modified'];
    }

    // car
    $query = selectPDO("select * from value_chart where name = 'car'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $car = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select u.email as email, a.car_out as car_out, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id where a.car_out <> 0", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "Car";
        $amount[] = $row['car'] * $car;
        $date[] = $row['date_modified'];
    }

    // house
    $query = selectPDO("select * from value_chart where name = 'house'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $house = $row['amount'] * $row['exchange'];
    }
    $query = selectPDO("select u.email as email, a.house_out as house_out, a.date_modified as date_modified from accounts a inner join users u on a.user_id = u.id where a.house_out <> 0", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $email[] = $row['email'];
        $type[] = "House";
        $amount[] = $row['house'] * $house;
        $date[] = $row['date_modified'];
    }

    array_multisort($date,SORT_DESC,$type,$amount, $email);
    $sn = 0;
    for($i=0; $i<sizeof($date); $i++){
        $sn++;
        $date_posted = date("D, j M Y g:i a", strtotime($date[$i]));
        $amnt = number_format($amount[$i]);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$email[$i]}</td>
                        <td>{$type[$i]}</td>
                        <td>&#8358; {$amnt}</td>
                        <td>{$date_posted}</td>
                    </tr>";
    }

    return $string;
}

function totalRefundHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, p.amount as amount, p.date_posted as date_posted from payouts p inner join users u on p.user_id = u.id where p.type = 'refund' order by p.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $amount = number_format(floatval($row['amount']), 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>&#8358; {$amount}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;   
}

function totalWithdrawalHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, w.amount as amount, w.note as note, w.beneficiary as beneficiary, w.date_posted as date_posted from withdrawals w inner join users u on w.admin = u.id order by w.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $amount = number_format(floatval($row['amount']), 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>&#8358; {$amount}</td>
                        <td>{$row['beneficiary']}</td>
                        <td>{$row['note']}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;
}

function totalDirectPayHistory(){
    $string = "";$sn=0;
    $query = selectPDO("select u.email as email, w.amount as amount, w.note as note, w.beneficiary as beneficiary, w.date_posted as date_posted from withdrawals w inner join users u on w.admin = u.id where w.beneficiary <> 'Self' order by w.date_posted desc", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $amount = number_format(floatval($row['amount']), 2);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$row['email']}</td>
                        <td>&#8358; {$amount}</td>
                        <td>{$row['beneficiary']}</td>
                        <td>{$row['note']}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    return $string;
}


function getRoles(){
    $string = "";
    $query = selectPDO("select * from roles", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $op = ucfirst($row['category']);
        $string .= "<option value='{$row['id']}'>{$op}</option>";
    }

    return $string;
}

function showAdmins(){
    
    $query = selectPDO("select * from users where roles is not NULL order by date_registered desc", array());
    $string = "";$sn=0;
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $sn++;
        if($row['user_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Active</span>";
        }elseif($row['user_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['user_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Disabled</span>";
        }
        $query2 = selectPDO("select * from roles where id = ?", array($row['roles']));
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $role = ucfirst($row2['category']);
        $date_registered = date("D, j M Y g:i a", strtotime($row['date_registered']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        $last_online = date("D, j M Y g:i a", strtotime($row['next_online']));
        $string .= "<tr>
                        <td>{$sn}</td>
                        <td>{$row['fname']} {$row['lname']}</td>
                        <td>{$row['email']}</td>
                        <td align='center'>{$status}</td>
                        <td align='center'>{$role}</td>
                        <td>{$date_registered}</td>
                        <td align='center'>
                            <button class='btn btn-success btn-sm' data-toggle='modal' data-target='#editAdmin{$row['id']}' data-placement='left' title='Manage'><i class='fa fa-edit' aria-hidden='true'></i></button>
                        </td>
                    </tr>
                    <div class='modal fade' id='editAdmin{$row['id']}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Manage Admin</h1>
                                        </div>

                                        <div class='modal-body'>
                                            <div class='card col-xs-12' style='padding: 0px;margin-bottom: 50px;'>
                                                <div class='card-header' style='background: #FFF;padding: 0px;'>
                                                    <img src='../../img/default-user.png'  style='margin-left: 2px;margin-bottom: -2px;' />
                                                </div>
                                                <div class='card-content'>
                                                    <div class='card-content-member'>
                                                        <h4 class='m-t-0'>{$row['fname']} {$row['lname']}</h4>
                                                        <p>{$role} Privileges</p>
                                                        <p>{$status}</p>
                                                    </div>
                                                    <div class='card-content-languages'>
                                                        <input type='text' name='admin_id' value='{$row['id']}' style='display:none;' />
                                                        <div class='card-content-languages-group'>
                                                            <div>
                                                                <h4>Email:</h4>
                                                            </div>
                                                            <div>
                                                                <ul>
                                                                    <li>{$row['email']}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class='card-content-languages-group'>
                                                            <div>
                                                                <h4>Password:</h4>
                                                            </div>
                                                            <div>
                                                                <ul>
                                                                    <li><a onclick='return confirm(\"Reset admin password?\");' href='?rp={$row['id']}'>Reset Password</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class='card-content-languages-group'>
                                                            <div>
                                                                <h4>Trans PIN:</h4>
                                                            </div>
                                                            <div>
                                                                <ul>
                                                                    <li><a onclick='return confirm(\"Master reset admin PIN?\");' href='?r={$row['id']}'>Master Reset PIN</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
                                                <div class='card-footer'>
                                                    <div class='card-footer-stats'>
                                                        <div>
                                                            <p>DATE <br/>REGISTERED:</p><br/><span class='stats-small'>{$date_registered}</span>
                                                        </div>
                                                        <div>
                                                            <p>LAST <br/>MODIFIED:</p><br/><span class='stats-small'>{$date_modified}</span>
                                                        </div>
                                                        <div>
                                                            <p>LAST <br/>ONLINE</p><br/><span class='stats-small'>{$last_online}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Change Privileges</label>
                                                <select name='roles' class='form-control' id='exampleSelect1'>
                                                    <option "; 
                                                    if($row['roles']==1){ $string .= "selected";}  
                                                        $string .= " value='1'>All</option>
                                                    <option "; 
                                                    if($row['roles']==2){ $string .= "selected";}  
                                                        $string .= " value='2'>User</option>
                                                    <option "; 
                                                    if($row['roles']==3){ $string .= "selected";}  
                                                        $string .= " value='3'>Transaction</option>
                                                    <option "; 
                                                    if($row['roles']==4){ $string .= "selected";}  
                                                        $string .= " value='4'>Tickets</option>
                                                    <option "; 
                                                    if($row['roles']==5){ $string .= "selected";}  
                                                        $string .= " value='5'>Media</option>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Change Account status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option value='1'>Active</option>
                                                    <option value='2'>Disabled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_admin' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
    }

    return $string;
}

function totalReferrals(){
    $string = "";$sn=0;
    $query = selectPDO("select distinct r.sponsor_id as sponsor_id, u.email as email, u.date_activated as date_activated, u.user_status as user_status, u.user_level as user_level, u.user_type as user_type from referrals r inner join users u on r.sponsor_id = u.id", array());
    $count = array();
    $email = array();
    $date_activated = array();
    $user_level = array();
    $user_status = array();
    $user_type = array();
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $query2 = selectPDO("select * from referrals where sponsor_id = ?", array($row['sponsor_id']));
        $count[] = $query2->rowCount();
        $date_activated[] = $row['date_activated'];
        $user_status[] = $row['user_status'];
        $user_type[] = $row['user_type'];
        $email[] = $row['email'];
        $user_level[] = $row['user_level'];
    }
    array_multisort($count,SORT_DESC,$email,$date_activated, $user_level, $user_status, $user_type);
    for($i=0; $i<sizeof($count); $i++){
        $sn++;
        $date = date("D, j M Y g:i a", strtotime($date_activated[$i]));
        if($user_status[$i]=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Active</span>";
        }elseif($user_status[$i]=="-1"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Blocked</span>";
        }elseif($user_status[$i]=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($user_status[$i]=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Declined</span>";
        }elseif($user_status[$i]=="4"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Restricted</span>";
        }elseif($user_status[$i]=="3"){
            $status="<span class='label label-pill label-danger-outline m-r-15'>Deactivated</span>";
        }
        $plan = ucfirst($user_type[$i]);
        $string .= "
                    <tr>
                        <td>{$sn}</td>
                        <td>{$email[$i]}</td>
                        <td>{$status}</td>
                        <td>{$plan}</td>
                        <td>{$user_level[$i]}</td>
                        <td>{$count[$i]}</td>
                        <td>{$date}</td>
                    </tr>";
    }
    
    return $string;
}

function totalRegUsers(){
    $count = 0;
    $query = selectPDO("select * from users where (user_status = '1' or user_status = '-1' or user_status = '3' or user_status = '4') and roles is NULL", array());
    $count = $query->rowCount();
    return $count;
}

function totalReferredUsers(){
    $count = 0;
    $query = selectPDO("select * from users where (user_status = '1' or user_status = '-1' or user_status = '3' or user_status = '4') and referral_code <> '000000' and roles is NULL", array());
    $count = $query->rowCount();
    return $count;
}

function totalOrganicUsers(){
    $count = 0;
    $query = selectPDO("select * from users where (user_status = '1' or user_status = '-1' or user_status = '3' or user_status = '4') and referral_code = '000000' and roles is NULL", array());
    $count = $query->rowCount();
    return $count;
}

function newsBadge($last_online, $next_online, $news_read){
    $news_badge = "";
    $query = selectPDO("select * from news_updates where date_posted >= ? and status = '1'", array($last_online));
    $size = $query->rowCount();
    if(($size>0 && $news_read<$next_online) || ($last_online==null && $news_read==null)){
        $query = selectPDO("select * from news_updates where status = '1'", array());
        $size2 = $query->rowCount();
        if($size>0 && $news_read<$next_online){
            $news_badge = "<span class='label label-warning' style='color:#000'>{$size}</span>";
        }elseif($size2>0){
            $news_badge = "<span class='label label-warning' style='color:#000'>{$size2}</span>";
        }
    }
    return $news_badge;
}

function closedTicketBadge($user_id){
    $size = 0;
    $query = selectPDO("select * from tickets where user_id = ? and ticket_status = '2' and read_status = '0'", array($user_id));
    $size += $query->rowCount();
    if($size>0){
        $closed_badge = "<span class='nav-tag yellow'>{$size}</span>";
    }else{
        $closed_badge = "";
    }
    return $closed_badge;
}

function openTicketBadge($user_id){
    $size = 0;
    $query = selectPDO("select * from tickets where user_id = ? and ticket_status = '1' and read_status = '0'", array($user_id));
    $size += $query->rowCount();
    if($size>0){
        $open_badge = "<span class='nav-tag green'>{$size}</span>";
    }else{
        $open_badge = "";
    }
    return $open_badge;
}

function getTags(){
    $string = "";
    $query = selectPDO("select * from news_tags", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $string .= "<br/><label><input type='checkbox' name='tags[]' value='{$row['id']}' /> {$row['name']}</label>";
    }
    return $string;
}

function bankInfo(){
    $head = "<ul class='nav nav-tabs'>"; $body = "<div class='tab-content'>";$count=0;
    $query = selectPDO("select * from bank_accounts", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        $head .= "<li ";
        if($count==0){
            $head .= "class='active'";
            $count++;
        }
        $head .= "><a href='#tab{$row['id']}' data-toggle='tab'>{$row['bank_name']}</a></li>";
        $body .= "<div class='tab-pane fade";
        if($count==1){
            $body .= "in active";
            $count++;
        }
        $body .= "' id='tab{$row['id']}'>
                    <div class='panel-body'>
                        <div class='col-xs-5' style='color:#FFF;margin-bottom:10px;'>Account Name:</div> <div class='col-xs-7' style='margin-bottom:10px;'>{$row['acct_name']}</div>

                        <div class='col-xs-5' style='color:#FFF;margin-bottom:10px;'>Account Number:</div> <div class='col-xs-7' style='margin-bottom:10px;'>{$row['acct_number']}</div>

                        <div class='col-xs-5' style='color:#FFF;margin-bottom:10px;'>Account Type:</div> <div class='col-xs-7' style='margin-bottom:10px;'>{$row['acct_type']}</div>

                        <div class='col-xs-5' style='color:#FFF;margin-bottom:10px;'>Swift Code:</div> <div class='col-xs-7' style='margin-bottom:10px;'>{$row['swift_code']}</div>
                    </div>
                </div>
                ";
    }
    $head .= "</ul>";
    $body .= "</div>";
    $string = $head.$body;
    return $string;
}

function bankInfoWeb(){
    $head = "<ul class='nav nav-tabs'>"; $body = "<div class='tab-content'>";$count=0;
    $query = selectPDO("select * from bank_accounts", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        $head .= "<li ";
        if($count==0){
            $head .= "class='active'";
            $count++;
        }
        $head .= "><a href='#tab{$row['id']}' style='color:#FE6802;font-size:17px;' data-toggle='tab'>{$row['bank_name']}</a></li>";
        $body .= "<div class='tab-pane fade";
        if($count==1){
            $body .= "in active";
            $count++;
        }
        $body .= "' id='tab{$row['id']}'>
                    <div class='panel-body' style='box-shadow:none;'>
                        <div class='col-xs-3' style='font-weight:bold;padding:0px;margin-top:20px;'>Account Name:</div> <div class='col-xs-9' style='margin-top:20px;'>{$row['acct_name']}</div>

                        <div class='col-xs-3' style='font-weight:bold;padding:0px;margin-top:20px;'>Account Number:</div> <div class='col-xs-9' style='margin-top:20px;'>{$row['acct_number']}</div>

                        <div class='col-xs-3' style='font-weight:bold;padding:0px;margin-top:20px;'>Account Type:</div> <div class='col-xs-9' style='margin-top:20px;'>{$row['acct_type']}</div>

                        <div class='col-xs-3' style='font-weight:bold;padding:0px;margin-top:20px;margin-bottom:20px;'>Swift Code:</div> <div class='col-xs-9' style='margin-top:20px;margin-bottom:20px;'>{$row['swift_code']}</div>
                    </div>
                </div>
                ";
    }
    $head .= "</ul>";
    $body .= "</div>";
    $string = $head.$body;
    return $string;
}

function listBankAccount(){
    $string = "";
    $query = selectPDO("select * from bank_accounts", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        $string .= "<option value='{$row['id']}'>{$row['bank_name']} ({$row['acct_number']})</option>";
    }
    return $string;
}

function validateAdmin($role){
    $query = selectPDO("select * from users where (roles = ? or roles = '1') and email_slug = ?", array($role, $_SESSION['blackloop_slug'][0]));
    
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/myadmin/index");
        exit;
    }
}

function validateSideAdmin($role){
    $query = selectPDO("select * from users where (roles = ? or roles = '1') and email_slug = ?", array($role, $_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        return false;
    }
    return true;
}

function validateUser(){
    $query = selectPDO("select * from users where roles is NULL and email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/myadmin/index");
        exit;
    }
}

function restrictUserTotal(){
    $query = selectPDO("select * from users where email_slug = ? and user_status = '1'", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        return false;
    }
    return true;
}

function restrictUserTotalTop(){
    $query = selectPDO("select * from users where email_slug = ? and user_status = '1'", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/index");
        exit;
    }
    
}

function restrictUserPartial(){
    $query = selectPDO("select * from users where email_slug = ? and (user_status = '1' or user_status = '4')", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        return false;
    }
    return true;
}

function restrictUserPartialTop(){
    $query = selectPDO("select * from users where email_slug = ? and (user_status = '1' or user_status = '4')", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/index");
        exit;
    }
}

function checkLogin(){
    if(isset($_SESSION['blackloop_slug']) && isset($_SESSION['blackloop_slug'][2]) && isset($_SESSION['blackloop_slug'][3]) && isset($_SESSION['blackloop_slug'][4]) && isset($_SESSION['blackloop_slug'][5])){
        
        $query = selectPDO("select * from users where email_slug = ? and fname = ? and lname = ? and profile_pic = ? and password = ? and (user_status =  '0' or user_status = '1' or user_status = '2' or user_status = '4')", array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][2], $_SESSION['blackloop_slug'][3], $_SESSION['blackloop_slug'][4], $_SESSION['blackloop_slug'][5]));
        
        // credentials don't match
        if($query->rowCount()==0){
            return false;
        }
        return true;
    }

    return false;
}

function getCountry($email_slug){
    $query = selectPDO("select * from users where email_slug = ?", array($email_slug));
    $row=$query->fetch(PDO::FETCH_ASSOC);
    if($row['country']!=" "){
        $country = $row['country'];
    }else{
        $country = "XX";
    }

    return $country;

}