<?php 
    require_once "functions_basic.php";

    $username = 'gt_payUser';
    $password = "gH8fr52k5dd.xN";
    $key = "GTB0962654576879476";

    // test: GTB152515276585

    $allowed_ips = array('127.0.0.1', '41.223.144.91');

    // stop crawlers or unauthorised access to script
    if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_ips)) {
        header('HTTP/1.1 403 Forbidden');
        die('Access Forbidden to ' .$_SERVER['REMOTE_ADDR']);
    }

    $inputJSON = file_get_contents('php://input');
    $input= json_decode( $inputJSON, TRUE ); //convert JSON into array
    
    
    if(isset($input['paymentUpdateRequest']['referenceID']) && isset($input['paymentUpdateRequest']['transReference']) && isset($input['paymentUpdateRequest']['totalAmount']) && isset($input['paymentUpdateRequest']['currency']) && isset($input['paymentUpdateRequest']['hash'])){
        
        $referenceID = $input['paymentUpdateRequest']['referenceID'];
        $transReference = $input['paymentUpdateRequest']['transReference'];
        $totalAmount = $input['paymentUpdateRequest']['totalAmount'];
        $currency = $input['paymentUpdateRequest']['currency'];
        $hash = $input['paymentUpdateRequest']['hash'];

        //confirm hash
        if(hash("sha512", "{$referenceID}{$transReference}{$totalAmount}{$currency}{$key}") != $hash){
            header('HTTP/1.1 403 Forbidden');
            die('incorrect hash string');
        }


        $query = selectPDO("select * from users where user_code = ?", array($referenceID));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $user_id = $row['id'];
            $phoneNumber = $row['phone_number'];
            $email = $row['email'];
            $referral_code = $row['referral_code'];
            $payer_name = $row['fname']." ".$row['lname'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $user_type = $row['user_type'];
        }
        $payment_type = "card";
        $elect_method = "GTCOLLECTIONS";
        $invoice = generateInvoiceNum();
        $memo = "Order from ".$payer_name;
        $products = ucfirst($user_type)." Membership";
        $quantity = "1";
        $transaction_status = "Success";
        $date = date("Y-m-d H:i:s");

        otherPDO("insert into payments (user_id, type, elect_method, trans_date, payer_name, user_type, amount, payment_status, date_posted, date_modified) values (?,?,?,?,?,?,?,?,?,?)", array($user_id, $payment_type, $elect_method, $date, $payer_name, $user_type, $totalAmount, "1", $date, $date));

        $query = selectPDO("select * from payments where user_id = ? and date_posted = ?", array($user_id, $date));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $payment_id = $row['id'];
        }

        otherPDO("insert into online_transactions (payment_id, user_id, phone, email, transaction_id, alt_email, total, total_paid_by_buyer, total_credited_to_merchant, merchant_ref, memo, products, quantity, transaction_status, transaction_date, cur, elect_method) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($payment_id, $user_id, $phoneNumber, $email, $payment_id, $email, $totalAmount, $totalAmount, $totalAmount, $invoice, $memo, $products, 
            $quantity, $transaction_status, $date, $currency, $elect_method));

        // SEND MESSAGE TO WELCOME USER
        $to = $email;
        $subject = "Welcome to Blackloop Club!";
        $query = selectPDO("select * from page_details where name = 'after_payment'", array());
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $register_email = $row['note'];
        $register_email = preg_replace("#FNAME#", $fname, $register_email);
        $register_email = preg_replace("#LNAME#", $lname, $register_email);
        $message = $register_email;
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
            'Reply-To: contact@blackloopclub.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);


        $notification_type = "welcome";
        sendNotification($user_id, $notification_type, "", "", "", "");

        otherPDO("update users set user_status = ?, user_level = ?, date_activated = ?, date_modified = ?, date_shifted =? where id = ?", array("1", "1", $date, $date, $date, $user_id));

        // create shift in the system
        createShifts();
        
        // payout bonusess
        if($referral_code!="000000"){
            payBonuses($referral_code, $user_id, $user_type, $date);
        }


        $responseCode = "00";
        $user_type = ucfirst($user_type);
        $responseDesc = "Dear {$payer_name}, thank you for paying for the Blackloop Club {$user_type} Membership Plan.";
        $newHash = hash("sha512", "{$referenceID}{$transReference}{$invoice}{$responseCode}{$responseDesc}{$key}");
        otherPDO("insert into gtb_collection_requests (reference_id, status_code, status_message, date_posted) values (?,?,?,?)", array($referenceID, $responseCode, $responseDesc, $date));
        $array = array(
            'referenceID'   =>  $referenceID,
            'transReference'  =>  $transReference,
            'paymentReference'   =>  $invoice,
            'responseCode'      =>  $responseCode,
            'responseDesc'    =>  $responseDesc,
            'hash'          =>  $newHash,
        );

        header('Content-type: application/json');
        echo json_encode($array);
        exit;
        

    }else{
        header('HTTP/1.1 403 Forbidden');
            die('mismatched post parameters');
    }

