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
    
    
    if(isset($input['validationRequest']['referenceID']) && isset($input['validationRequest']['hash']) && isset($input['validationRequest']['username']) && isset($input['validationRequest']['password'])){
        
        $referenceID = $input['validationRequest']['referenceID'];
        $hash = $input['validationRequest']['hash'];
        $user = $input['validationRequest']['username'];
        $pass = $input['validationRequest']['password'];

        //confirm hash and username and password
        if($user != $username){
            header('HTTP/1.1 403 Forbidden');
            die('incorrect username');
        }elseif($pass != $password){
            header('HTTP/1.1 403 Forbidden');
            die('incorrect password');
        }elseif(hash("sha512", "{$referenceID}{$user}{$pass}{$key}") != $hash){
            header('HTTP/1.1 403 Forbidden');
            die('incorrect hash string');
        }

        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where user_code =?", array($referenceID));
        if($query->rowCount()==0){
            $statusCode = "01";
            $statusMessage = "Usercode is invalid or user cannot make this payment!";
            $newHash = hash("sha512", "{$referenceID}{$statusCode}{$statusMessage}{$key}");
            otherPDO("insert into gtb_collection_requests (reference_id, status_code, status_message, date_posted) values (?,?,?,?)", array($referenceID, $statusCode, $statusMessage, $date));
            $array = array(
                'referenceID'       => $referenceID,
                'statusCode'      => $statusCode,
                'statusMessage'       => $statusMessage,
                'hash'    => $newHash,
            );

            header('Content-type: application/json');
            echo json_encode($array);
            exit;
        }

        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $referenceID = $referenceID;
            $customerName = $row['fname']." ".$row['lname'];
            $query2 = selectPDO("select * from payout_settings", array());
            while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
                if($row2['type']==$row['user_type']){
                    $totalAmount = $row2['amount'] * $row2['exchange'];
                }
            }
            $currency = "566";
            $statusCode = "00";
            $user_type = ucfirst($row['user_type']);
            $statusMessage = "Dear {$customerName}, please proceed to make payment of N{$totalAmount} for your Blackloop Club {$user_type} Membership Plan.";
            $newHash = hash("sha512", "{$referenceID}{$customerName}{$totalAmount}{$currency}{$statusCode}{$statusMessage}{$key}");
            otherPDO("insert into gtb_collection_requests (reference_id, status_code, status_message, date_posted) values (?,?,?,?)", array($referenceID, $statusCode, $statusMessage, $date));
            $array = array(
                'referenceID'   =>  $referenceID,
                'customerName'  =>  $customerName,
                'totalAmount'   =>  $totalAmount,
                'currency'      =>  $currency,
                'statusCode'    =>  $statusCode,
                'statusMessage' =>  $statusMessage,
                'hash'          =>  $newHash,
            );

            header('Content-type: application/json');
            echo json_encode($array);
            exit;
        }
        

    }

