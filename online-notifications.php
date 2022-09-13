<?php

	$merchant_id = '8129-0060573';
	if(isset($_POST['transaction_id'])){

        //get the full transaction details as an xml from voguepay
        $xml = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id']);
        //parse our new xml
        $xml_elements = new SimpleXMLElement($xml);
        //create new array to store our transaction detail
        $transaction = array();
        //loop through the $xml_elements and populate our $transaction array
        foreach($xml_elements as $key => $value) 
        {
                $transaction[$key]=$value;
        }
                
        /*You can do anything you want now with the transaction details or the merchant reference.
        You should query your database with the merchant reference and fetch the records you saved for this transaction.
        Then you should compare the $transaction['total'] with the total from your database.*/
        
        if($transaction['merchant_id'] == $merchant_id){
        	$merchant_ref = $transaction['merchant_ref'];
        	$transaction_id = $transaction['transaction_id'];
            $query = selectPDO("select u.phone_number as phone_number, u.email as email, u.id as id, u.referral_code as referral_code, o.online_method as online_method, o.payment_id as payment_id from online_transactions o inner join users u on o.user_id = u.id where o.merchant_ref = ? and o.transaction_id = ?", array($merchant_ref, $transaction_id));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $phoneNumber = $row['phone_number'];
                $email = $row['email'];
                $referral_code = $row['referral_code'];
                $user_id = $row['id'];
	            $elect_method = $_SESSION['online_method'];
	            $payment_id = $_SESSION['payment_id'];
            }
            
            $total_paid_by_buyer = $transaction['total_paid_by_buyer'];
            $total_credited_to_merchant = $transaction['total_credited_to_merchant'];
            $extra_charges_by_merchant = $transaction['extra_charges_by_merchant'];
            $fund_maturity = $transaction['fund_maturity'];
            $total = $transaction['total'];
            $transaction_status = $transaction['status'];
            
            $date = date("Y-m-d H:i:s");

            otherPDO("update online_transactions total = ?, total_paid_by_buyer = ?, total_credited_to_merchant = ?, extra_charge_by_merchant = ?, transaction_status, fund_maturity where merchant_ref = ? and transaction_id = ?", array($total, $total_paid_by_buyer, $total_credited_to_merchant, $extra_charges_by_merchant, $transaction_status, $fund_maturity));

            if($transaction['status'] == 'Approved' && $transaction['total'] > 0){
                // SEND MESSAGE TO WELCOME USER
                $query = selectPDO("select * from users where id = ?", array($user_id));
                $row=$query->fetch(PDO::FETCH_ASSOC);
                $fname = $row['fname'];
                $lname = $row['lname'];
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

                otherPDO("update payments set date_modified=?, amount=?, payment_status = ? where id = ?", array($date, $total_credited_to_merchant, "1", $payment_id));

                otherPDO("update users set user_status = ?, user_level = ?, date_activated = ?, date_modified = ?, date_shifted =? where id = ?", array("1", "1", $date, $date, $date, $user_id));

                // create shift in the system
                createShifts();
                
                // payout bonusess
                if($referral_code!="000000"){
                    payBonuses($referral_code, $user_id, $user_type, $date);
                }

            }elseif($transaction['status'] == 'Failed' || $transaction['status'] == 'Disputed'){
                otherPDO("update payments set date_modified=?, payment_status = ? where id = ?", array($date, "2", $payment_id));

                otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $user_id));
            }
        }
    }