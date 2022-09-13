<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php";

    validateAdmin(2);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    $countries = ['AF'=>"Afghanistan",
    'AX'=>"Ã…land Islands",
    'AL'=>"Albania",
    'DZ'=>"Algeria",
    'AS'=>"American Samoa",
    'AD'=>"Andorra",
    'AO'=>"Angola",
    'AI'=>"Anguilla",
    'AQ'=>"Antarctica",
    'AG'=>"Antigua and Barbuda",
    'AR'=>"Argentina",
    'AM'=>"Armenia",
    'AW'=>"Aruba",
    'AU'=>"Australia",
    'AT'=>"Austria",
    'AZ'=>"Azerbaijan",
    'BS'=>"Bahamas",
    'BH'=>"Bahrain",
    'BD'=>"Bangladesh",
    'BB'=>"Barbados",
    'BY'=>"Belarus",
    'BE'=>"Belgium",
    'BZ'=>"Belize",
    'BJ'=>"Benin",
    'BM'=>"Bermuda",
    'BT'=>"Bhutan",
    'BO'=>"Bolivia, Plurinational State of",
    'BQ'=>"Bonaire, Sint Eustatius and Saba",
    'BA'=>"Bosnia and Herzegovina",
    'BW'=>"Botswana",
    'BV'=>"Bouvet Island",
    'BR'=>"Brazil",
    'IO'=>"British Indian Ocean Territory",
    'BN'=>"Brunei Darussalam",
    'BG'=>"Bulgaria",
    'BF'=>"Burkina Faso",
    'BI'=>"Burundi",
    'KH'=>"Cambodia",
    'CM'=>"Cameroon",
    'CA'=>"Canada",
    'CV'=>"Cape Verde",
    'KY'=>"Cayman Islands",
    'CF'=>"Central African Republic",
    'TD'=>"Chad",
    'CL'=>"Chile",
    'CN'=>"China",
    'CX'=>"Christmas Island",
    'CC'=>"Cocos (Keeling) Islands",
    'CO'=>"Colombia",
    'KM'=>"Comoros",
    'CG'=>"Congo",
    'CD'=>"Congo, the Democratic Republic of the",
    'CK'=>"Cook Islands",
    'CR'=>"Costa Rica",
    'CI'=>"CÃ´te d'Ivoire",
    'HR'=>"Croatia",
    'CU'=>"Cuba",
    'CW'=>"CuraÃ§ao",
    'CY'=>"Cyprus",
    'CZ'=>"Czech Republic",
    'DK'=>"Denmark",
    'DJ'=>"Djibouti",
    'DM'=>"Dominica",
    'DO'=>"Dominican Republic",
    'EC'=>"Ecuador",
    'EG'=>"Egypt",
    'SV'=>"El Salvador",
    'GQ'=>"Equatorial Guinea",
    'ER'=>"Eritrea",
    'EE'=>"Estonia",
    'ET'=>"Ethiopia",
    'FK'=>"Falkland Islands (Malvinas)",
    'FO'=>"Faroe Islands",
    'FJ'=>"Fiji",
    'FI'=>"Finland",
    'FR'=>"France",
    'GF'=>"French Guiana",
    'PF'=>"French Polynesia",
    'TF'=>"French Southern Territories",
    'GA'=>"Gabon",
    'GM'=>"Gambia",
    'GE'=>"Georgia",
    'DE'=>"Germany",
    'GH'=>"Ghana",
    'GI'=>"Gibraltar",
    'GR'=>"Greece",
    'GL'=>"Greenland",
    'GD'=>"Grenada",
    'GP'=>"Guadeloupe",
    'GU'=>"Guam",
    'GT'=>"Guatemala",
    'GG'=>"Guernsey",
    'GN'=>"Guinea",
    'GW'=>"Guinea-Bissau",
    'GY'=>"Guyana",
    'HT'=>"Haiti",
    'HM'=>"Heard Island and McDonald Islands",
    'VA'=>"Holy See (Vatican City State)",
    'HN'=>"Honduras",
    'HK'=>"Hong Kong",
    'HU'=>"Hungary",
    'IS'=>"Iceland",
    'IN'=>"India",
    'ID'=>"Indonesia",
    'IR'=>"Iran, Islamic Republic of",
    'IQ'=>"Iraq",
    'IE'=>"Ireland",
    'IM'=>"Isle of Man",
    'IL'=>"Israel",
    'IT'=>"Italy",
    'JM'=>"Jamaica",
    'JP'=>"Japan",
    'JE'=>"Jersey",
    'JO'=>"Jordan",
    'KZ'=>"Kazakhstan",
    'KE'=>"Kenya",
    'KI'=>"Kiribati",
    'KP'=>"Korea, Democratic People's Republic of",
    'KR'=>"Korea, Republic of",
    'KW'=>"Kuwait",
    'KG'=>"Kyrgyzstan",
    'LA'=>"Lao People's Democratic Republic",
    'LV'=>"Latvia",
    'LB'=>"Lebanon",
    'LS'=>"Lesotho",
    'LR'=>"Liberia",
    'LY'=>"Libya",
    'LI'=>"Liechtenstein",
    'LT'=>"Lithuania",
    'LU'=>"Luxembourg",
    'MO'=>"Macao",
    'MK'=>"Macedonia, the former Yugoslav Republic of",
    'MG'=>"Madagascar",
    'MW'=>"Malawi",
    'MY'=>"Malaysia",
    'MV'=>"Maldives",
    'ML'=>"Mali",
    'MT'=>"Malta",
    'MH'=>"Marshall Islands",
    'MQ'=>"Martinique",
    'MR'=>"Mauritania",
    'MU'=>"Mauritius",
    'YT'=>"Mayotte",
    'MX'=>"Mexico",
    'FM'=>"Micronesia, Federated States of",
    'MD'=>"Moldova, Republic of",
    'MC'=>"Monaco",
    'MN'=>"Mongolia",
    'ME'=>"Montenegro",
    'MS'=>"Montserrat",
    'MA'=>"Morocco",
    'MZ'=>"Mozambique",
    'MM'=>"Myanmar",
    'NA'=>"Namibia",
    'NR'=>"Nauru",
    'NP'=>"Nepal",
    'NL'=>"Netherlands",
    'NC'=>"New Caledonia",
    'NZ'=>"New Zealand",
    'NI'=>"Nicaragua",
    'NE'=>"Niger",
    'NG'=>"Nigeria",
    'NU'=>"Niue",
    'NF'=>"Norfolk Island",
    'MP'=>"Northern Mariana Islands",
    'NO'=>"Norway",
    'OM'=>"Oman",
    'PK'=>"Pakistan",
    'PW'=>"Palau",
    'PS'=>"Palestinian Territory, Occupied",
    'PA'=>"Panama",
    'PG'=>"Papua New Guinea",
    'PY'=>"Paraguay",
    'PE'=>"Peru",
    'PH'=>"Philippines",
    'PN'=>"Pitcairn",
    'PL'=>"Poland",
    'PT'=>"Portugal",
    'PR'=>"Puerto Rico",
    'QA'=>"Qatar",
    'RE'=>"RÃ©union",
    'RO'=>"Romania",
    'RU'=>"Russian Federation",
    'RW'=>"Rwanda",
    'BL'=>"Saint BarthÃ©lemy",
    'SH'=>"Saint Helena, Ascension and Tristan da Cunha",
    'KN'=>"Saint Kitts and Nevis",
    'LC'=>"Saint Lucia",
    'MF'=>"Saint Martin (French part)",
    'PM'=>"Saint Pierre and Miquelon",
    'VC'=>"Saint Vincent and the Grenadines",
    'WS'=>"Samoa",
    'SM'=>"San Marino",
    'ST'=>"Sao Tome and Principe",
    'SA'=>"Saudi Arabia",
    'SN'=>"Senegal",
    'RS'=>"Serbia",
    'SC'=>"Seychelles",
    'SL'=>"Sierra Leone",
    'SG'=>"Singapore",
    'SX'=>"Sint Maarten (Dutch part)",
    'SK'=>"Slovakia",
    'SI'=>"Slovenia",
    'SB'=>"Solomon Islands",
    'SO'=>"Somalia",
    'ZA'=>"South Africa",
    'GS'=>"South Georgia and the South Sandwich Islands",
    'SS'=>"South Sudan",
    'ES'=>"Spain",
    'LK'=>"Sri Lanka",
    'SD'=>"Sudan",
    'SR'=>"Suriname",
    'SJ'=>"Svalbard and Jan Mayen",
    'SZ'=>"Swaziland",
    'SE'=>"Sweden",
    'CH'=>"Switzerland",
    'SY'=>"Syrian Arab Republic",
    'TW'=>"Taiwan, Province of China",
    'TJ'=>"Tajikistan",
    'TZ'=>"Tanzania, United Republic of",
    'TH'=>"Thailand",
    'TL'=>"Timor-Leste",
    'TG'=>"Togo",
    'TK'=>"Tokelau",
    'TO'=>"Tonga",
    'TT'=>"Trinidad and Tobago",
    'TN'=>"Tunisia",
    'TR'=>"Turkey",
    'TM'=>"Turkmenistan",
    'TC'=>"Turks and Caicos Islands",
    'TV'=>"Tuvalu",
    'UG'=>"Uganda",
    'UA'=>"Ukraine",
    'AE'=>"United Arab Emirates",
    'GB'=>"United Kingdom",
    'US'=>"United States",
    'UM'=>"United States Minor Outlying Islands",
    'UY'=>"Uruguay",
    'UZ'=>"Uzbekistan",
    'VU'=>"Vanuatu",
    'VE'=>"Venezuela, Bolivarian Republic of",
    'VN'=>"Viet Nam",
    'VG'=>"Virgin Islands, British",
    'VI'=>"Virgin Islands, U.S.",
    'WF'=>"Wallis and Futuna",
    'EH'=>"Western Sahara",
    'YE'=>"Yemen",
    'ZM'=>"Zambia",
    'ZW'=>"Zimbabwe",];

   
    if(isset($_POST['update_user'])){
        $status = $_POST['status'];
        otherPDO("update users set user_status = ? where user_code = ?", array($status, $_GET['x']));
        $success = "Update was successful!";
    }

    if(isset($_POST['update_payment'])){
        $payment_id = $_POST['payment_id'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        $date = date("Y-m-d H:i:s");
        $user_type = "privilege";

        $query = selectPDO("select * from users where user_code = ?", array($_GET['x']));
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $id = $row['id'];
            $referral = $row['referral_code'];
        }
        
        if($status=="1"){
            otherPDO("update payments set amount = ?, payment_status = ?, date_modified = ?, admin = ? where id = ?", array($amount, $status, $date, $admin_id, $payment_id));
            otherPDO("update users set user_status = ?, user_level = ?, date_activated = ?, date_modified = ?, date_shifted =? where id = ?", array("1", "1", $date, $date, $date, $id));
            $success = "Update was successful!";

            // SEND MESSAGE TO WELCOME USER
            $query = selectPDO("select * from users where id = ?", array($id));
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
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
            sendNotification($id, $notification_type, "", "", "", "");

            // create shift in the system
            createShifts();
            
            // payout bonusess
            if($referral!="000000"){
                payBonuses($referral, $id, $user_type, $date);
            }

        }elseif($status=="2"){
            otherPDO("update payments set payment_status = ?, date_modified = ?, admin = ? where id = ?", array($status, $date, $admin_id, $payment_id));
            otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $id));
            $success = "Update was successful!";
        }elseif($status=="3"){
            otherPDO("update payments set amount = ?, payment_status = ?, date_modified = ?, admin = ? where id = ?", array($amount, $status, $date, $admin_id, $payment_id));
            otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $id));
            $success = "Update was successful!";
        }elseif($status=="4"){
            $query = selectPDO("select * from payments where id = ?", array($payment_id));
            while($row = $query->fetch(PDO::FETCH_ASSOC)){
                if(!unlink("../".$row['file'])){
                    echo "error deleting file";
                }
            }
            otherPDO("delete from payments where id = ?", array($payment_id));
            $success = "Update was successful!";
        }
    }

    if(isset($_GET['x'])){
        $query = selectPDO("select * from users where user_code = ?", array($_GET['x']));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $dp = "../../".$row['profile_pic'];
            $names = $row['fname']." ".$row['lname'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $city = $row['city'];
            $zip_code = $row['zip_code'];
            foreach ($countries as $key => $nation) {
                if($row['country'] == $key){$country=$nation;}
            }
            $location = $row['city'].", ".$country.", ".$row['zip_code'];
            $level = $row['user_level'];
            $user_status = $row['user_status'];
            if($row['user_status']=="1"){
                $status="<span class='label label-outline label-success-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Active</span>";
            }elseif($row['user_status']=="-1"){
                $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Blocked</span>";
            }elseif($row['user_status']=="0"){
                $status="<span class='label label-outline label-primary-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Pending</span>";
            }elseif($row['user_status']=="2"){
                $status="<span class='label label-outline label-warning-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Declined</span>";
            }elseif($row['user_status']=="4"){
                $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Restricted</span>";
            }elseif($row['user_status']=="3"){
                $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Deactivated</span>";
                $query2 = selectPDO("select * from deactivation_reviews where user_id = ?", array($row['id']));
                while ($row2=$query2->fetch(PDO::FETCH_ASSOC)) {
                    $review = $row2['review'];
                    if($review==""){$review="NILL";}
                    $review_date = date("D, j M Y g:i a", strtotime($row2['date_posted']));
                }
            }
            $user_type = strtoupper($row['user_type']);
            $user_id = $row['id'];
            $address = $row['street_address'];
            $email = $row['email'];
            $phone = $row['phone_number'];
            $user_code = $row['user_code'];
            $date_registered = date("D, j M Y g:i a", strtotime($row['date_registered']));
            $date_activated = date("D, j M Y g:i a", strtotime($row['date_activated']));
            $last_online = date("D, j M Y g:i a", strtotime($row['next_online']));
            if($row['birthday']==NULL){
                $birthday = "N/a";
            }else{
                $birthday = date("j M Y", strtotime($row['birthday']));
            }
            if(trim($row['bank_name'])==""){$bank_name="n/a";$bank_name2 = $row['bank_name'];}else{$bank_name = $bank_name2 = $row['bank_name'];}
            if(trim($row['acct_name'])==""){$acct_name="n/a";$acct_name2 = $row['acct_name'];}else{$acct_name = $acct_name2 = $row['acct_name'];}
            if(trim($row['acct_number'])==""){$acct_number="n/a";$acct_number2 = $row['acct_number'];}else{$acct_number = $acct_number2 = $row['acct_number'];}
            if(trim($row['acct_type'])==""){$acct_type="n/a";$acct_type2 = $row['acct_type'];}else{$acct_type = $acct_type2 = $row['acct_type'];}
            if(trim($row['swift_code'])==""){$swift_code="n/a";$swift_code2 = $row['swift_code'];}else{$swift_code = $swift_code2 = $row['swift_code'];}

        }

        if($query->rowCount()==0){
            header("Location: users");
            exit;
        }
       

        $query = selectPDO("select * from accounts where user_id = ?", array($user_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $wallet_bal = $row['wallet_bal'];
            $voucher_bal = $row['voucher_bal'];
            $car = $row['car'];
            $house = $row['house'];
        }

        $query=selectPDO("select * from referrals where sponsor_id = ?", array($user_id));
        $referrals=$query->rowCount();

        $query = selectPDO("select * from payments where user_id = ? order by date_posted desc", array($user_id));
        $size = $query->rowCount();
        $payment = "";
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $payment_id = $row['id'];
            $type = strtoupper($row['user_type']);
            $option = ucfirst($row['type']);
            $trans_date = substr(date("D, j M Y g:i a", strtotime($row['trans_date'])), 0, 16);
            $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
            $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
            if($row['payment_status']=="0"){
                if($row['type']=="card"){
                    $payment_status = "Pending Transaction";
                    $signature = "Processing...";
                }else{
                    $payment_status = "Pending <span class='btn btn-warning' data-toggle='modal' data-target='#Modal{$payment_id}' style='padding:2px 7px'><span class='fa fa-edit'></span> Update</span>";
                    $signature = "";
                }
            }elseif($row['payment_status']=="1"){
                $payment_status = "Approved";
                if($row['admin']!=NULL){
                    $query2=selectPDO("select * from users where id = ?", array($row['admin']));
                    $row2=$query2->fetch(PDO::FETCH_ASSOC);
                    $signature = "<div class='form-group text-center'>
                                <p>Approved by: {$row2['email']}</p>
                            </div>";
                }else{
                    $signature = "<div class='form-group text-center'>
                                <p>Automatic Approval</p>
                            </div>";
                }
            }elseif($row['payment_status']=="3"){
                $payment_status = "Partial Approval";
                if($row['admin']!=NULL){
                    $query2=selectPDO("select * from users where id = ?", array($row['admin']));
                    $row2=$query2->fetch(PDO::FETCH_ASSOC);
                    $signature = "<div class='form-group text-center'>
                                <p>Approved by: {$row2['email']}</p>
                            </div>";
                }else{
                    $signature = "<div class='form-group text-center'>
                                <p>Automatic Approval</p>
                            </div>";
                }
            }elseif($row['payment_status']=="2"){
                $payment_status = "Declined";
                if($row['admin']!=NULL){
                    $query2=selectPDO("select * from users where id = ?", array($row['admin']));
                    $row2=$query2->fetch(PDO::FETCH_ASSOC);
                    $signature = "<div class='form-group text-center'>
                                <p>Approved by: {$row2['email']}</p>
                            </div>";
                }else{
                    $signature = "<div class='form-group text-center'>
                                <p>Automatic Approval</p>
                            </div>";
                }
            }
            if(trim($row['amount'])==""){$amount="n/a";}else{$amount=$row['amount'];}
            $payment .= "<div class='modal fade' id='Modal{$payment_id}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <input type='hidden' name='payment_id' value='{$payment_id}' />
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Update Payment Info</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleInputEmail1'>Amount paid</label>
                                                <input type='number' required name='amount' class='form-control' id='exampleInputEmail1' aria-describedby='emailHelp' placeholder='Enter amount'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Select status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option value='0'>Pending</option>
                                                    <option value='1'>Approve</option>
                                                    <option value='3'>Partial Approval</option>
                                                    <option value='2'>Decline</option>
                                                    <option value='4'>Delete</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick='return confirm(\"Save changes?\")' name='update_payment' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
            if($row['type']=="deposit"){
                
                $payment .= "
                            <div class='row' style='margin-top: 10px;'>
                                <div class='col-sm-5'>
                                    <img src='../../{$row['file']}' width='100%' class='img-rounded' alt='deposit slip image'>
                                    <div class='btn btn-primary col-xs-12' data-toggle='modal' data-target='#enlarge{$payment_id}' style='margin-top:-30px;margin-bottom:20px;'><span class='fa fa-search-plus'></span> Enlarge Image</div>
                                </div>
                                <div class='col-sm-7'>
                                    <div style='width: 40%;color:#FFF;float:left;'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                                </div>
                            </div>

                            <div class='modal fade' id='enlarge{$payment_id}' tabindex='-1' role='dialog'>
                                <div class='modal-dialog' role='document'>
                                    <div class='modal-content'>
                                        <input type='hidden' name='payment_id' value='{$payment_id}' />
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Uploaded File</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <img src='../../{$row['file']}' width='100%' class='img-rounded' alt='deposit slip image'>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>{$signature}<hr/>";
            }elseif($row['type']=="transfer"){
                
                $payment .= "
                            <div class='row' style='margin-top: 10px;'>
                                <div class='col-sm-12'>
                                    <div style='width: 40%;color:#FFF;float:left'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Bank Name:</div><div style='width:60%;float:left'>{$row['bank_name']}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Acct. Name:</div><div style='width:60%;float:left'>{$row['acct_name']}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Acct. Number:</div><div style='width:60%;float:left'>{$row['acct_number']}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Trans. Date:</div><div style='width:60%;float:left'>{$trans_date}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Payer Name:</div><div style='width:60%;float:left'>{$row['payer_name']}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                    <div style='width: 40%;color:#FFF;float:left'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                                </div>
                            </div>
                            <hr>{$signature}<hr/>";
            }elseif($row['type']=="card"){
                
                $payment .= "
                            <div class='row' style='margin-top: 10px;'>
                                <div class='col-sm-12'>
                                    <div style='width: 40%;float:left;color:#FFF;'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Method:</div><div style='width:60%;float:left'>{$row['elect_method']}</div><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                    <div style='width: 40%;float:left;color:#FFF;'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                                </div>
                            </div>
                            <hr>{$signature}<hr/>";
            }
        }
    }else{
        header("Location: users");
        exit;
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>User Profile | Blackloop Club</title>
        <?php require_once "styles.php"; ?>
    </head>
    <body>
        <div id="wrapper" class="wrapper animsition">
            <?php 
                require_once "header.php"; 
                require_once "sidebar-left.php"; 
                // require_once "sidebar-right.php"; 
            ?>
            
            <div class="control-sidebar-bg"></div>

            <div id="page-wrapper">
                <div class="content">
                   
                    <div class="content-header">
                         <?php require_once "../news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <div class="header-title">
                            <h1>User Profile</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } ?>
                        <div class="col-sm-12 col-md-4">
                            <div class="card col-xs-12" style="padding: 0px;margin-bottom: 50px;">
                                <div class="card-header" style="background: #FFF;padding: 0px;">
                                    <img src="<?php echo $dp; ?>" width="100%" style="margin-left: 2px;margin-bottom: -2px;" />
                                    <?php echo $status; ?>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-member">
                                        <h4 class="m-t-0"><?php echo $names; ?></h4>
                                        <p class="m-0"><i class="pe-7s-map-marker"></i><?php echo $location; ?></p>
                                    </div>
                                    <div class="card-content-languages">
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Email:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li style="word-wrap: break-word;table-layout: fixed;width: 200px;"><?php echo $email; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Phone:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $phone ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Address:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li style="word-wrap: break-word;table-layout: fixed;width: 200px;"><?php echo $address; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Birthday:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $birthday; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>User Code:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $user_code; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>No. of Referrals:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $referrals; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer-stats">
                                        <div>
                                            <p>DATE <br/>REGISTERED:</p><br/><span class="stats-small"><?php echo $date_registered; ?></span>
                                        </div>
                                        <div>
                                            <p>DATE <br/>ACTIVATED:</p><br/><span class="stats-small"><?php echo $date_activated; ?></span>
                                        </div>
                                        <div>
                                            <p>LAST <br/>ONLINE</p><br/><span class="stats-small"><?php echo $last_online; ?></span>
                                        </div>
                                    </div>
                                    <?php if($user_status!="0" && $user_status!="3"){ ?>
                                    <div data-toggle="modal" data-target="#editUserModal
                                    " class="card-footer-message btn btn-success col-xs-12">
                                        <h4><i class="fa fa-edit"></i> Update User</h4>
                                    </div>
                                    <?php } if($user_status=="3"){ ?>
                                    <div class="col-xs-12 text-center" style="margin-top: 5px;">
                                        <b style="color: #FFF;">REASON FOR DEACTIVATION:</b><br/><br/><?php echo $review; ?>
                                    </div>
                                    <div class="col-xs-12 text-center" style="margin-top: 5px;">
                                        On <?php echo $review_date; ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class='modal fade' id='editUserModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Update User</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Select status</label>
                                                <select name='status' class='form-control' id='exampleSelect1'>
                                                    <option value='1'>Active</option>
                                                    <option value='-1'>Blocked</option>
                                                    <option value='4'>Restricted</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' onclick="return confirm('Save changes?');" name='update_user' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>User Level: <small style="font-size: 17px;margin-left: 10px;"><?php if($level!="exclusive"){ echo $level; $rem = 7-$level; }else{ echo "Exclusive"; } ?> (<?php echo $user_type; ?>)</small></h4>
                                        <?php if($level!="exclusive"){
                                        for($i=0; $i<$level; $i++){ ?>
                                        <button type="button" class="btn btn-success btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php } for($i=0; $i<$rem; $i++){ ?>
                                        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php }}else{ for($i=0; $i<7; $i++){ ?>
                                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php }} ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <!-- <h4 class="m-t-0">Bonuses</h4> -->
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fab fa-google-wallet" style="font-weight: bold;"> Wallet Balance: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($wallet_bal, 2); ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fa fa-shopping-cart"> Shopping Voucher: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($voucher_bal, 2); ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fa fa-car"> Car Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $car; ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                       <span class="fa fa-home"> House Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $house; ?></span></span>
                                    </div>
                                </div>          
                            </div>

                            
                            <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;text-transform: uppercase;padding: 10px;cursor: text;">Bank Account Info</h2>

                            <div class="review-block">
                                <div class='row' style='margin-top: 10px;'>
                                    <div class='col-sm-12'>
                                        <div style='width: 40%;float:left;color:#FFF;'>Bank Name:</div><div style='width:60%;float:left'><?php echo $bank_name; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account Name:</div><div style='width:60%;float:left'><?php echo $acct_name; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account No.:</div><div style='width:60%;float:left'><?php echo $acct_number; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account Type:</div><div style='width:60%;float:left'><?php echo $acct_type; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Swift Code:</div><div style='width:60%;float:left'><?php echo $swift_code; ?></div><br/>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;text-transform: uppercase;padding: 10px;cursor: text;">Payments (<?php echo $size; ?>) 
                                </h2>

                            <div class="review-block">
                               <?php echo $payment; ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
