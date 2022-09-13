<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();
    restrictUserPartialTop();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
        $referral_lead = $row['referral_lead'];
        $user_code = $row['user_code'];
    }

    $query = selectPDO("select * from payout_settings where type = 'bank'", array());
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $transfer_charge = $row['amount']."%";

    if(isset($_POST['referral_submit'])){
        $amount = $_POST['amount'];
        $trans_pin = $_POST['trans_pin'];
        $referral = $_POST['referral'];
        if(isset($_POST['others'])){$others = $_POST['others'];}else{$others="";}
        $date = date("Y-m-d H:i:s");

        if($amount==null || $trans_pin ==null){
            $error = "Please enter valid amount or transaction PIN";
        }elseif($referral!=""){
            if($others!=""){
                $referral .= " (".$_POST['others'].")";
            }

            otherPDO("update users set referral_lead = ? where user_code = ?", array($referral, $user_code));

            $query = selectPDO("select * from users where user_code = ?", array($user_code));
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $pin = $row['user_pin'];

            if(!password_verify($trans_pin, $pin)){
                $error = "Transaction PIN is incorrect!";
            }elseif($amount>=40000){

                $query = selectPDO("select * from users where user_code = ?", array($user_code));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $user_id = $row['id'];
                    $bank_name = $row['bank_name'];
                    $acct_name = $row['acct_name'];
                    $acct_number = $row['acct_number'];
                }

                otherPDO("insert into transfers (user_id, bank_name, acct_name, acct_number, amount, type, date_posted, date_modified) values (?,?,?,?,?,?,?,?)", array($user_id, $bank_name, $acct_name, $acct_number, $amount, "wallet_bank", $date, $date));
                $success = "Transfer request submitted successfully!";
            }else{
                $error = "Please enter an amount greater than or equal to &#8358; 40, 000!";
            }
        }else{
            $error = "Please select one option from the survey!";
        }
    }

    if(isset($_POST['submit'])){
        $amount = $_POST['amount'];
        $trans_pin = $_POST['fakepasswordremembered'];
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $pin = $row['user_pin'];

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }elseif($amount>=40000){

            $query = selectPDO("select * from users where user_code = ?", array($user_code));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $user_id = $row['id'];
                $bank_name = $row['bank_name'];
                $acct_name = $row['acct_name'];
                $acct_number = $row['acct_number'];
            }

            otherPDO("insert into transfers (user_id, bank_name, acct_name, acct_number, amount, type, date_posted, date_modified) values (?,?,?,?,?,?,?,?)", array($user_id, $bank_name, $acct_name, $acct_number, $amount, "wallet_bank", $date, $date));
            $success = "Transfer request submitted successfully!";
        }else{
            $error = "Please enter an amount greater than or equal to &#8358; 40, 000!";
        }
    }

    
    $query = selectPDO("select * from payout_settings", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        if($row['type']=='privilege'){
            $exchange1 = $row['exchange'];
        }

        if($row['type']=='level'){
            $exchange2 = $row['exchange'];
        }
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
        <title>Wallet to Bank | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .btn-labeled {
                float: right;
            }

            @media(max-width: 767px){
                .btn-labeled {
                    float: left;
                }
            }
        </style>
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
                         <?php require_once "news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-exchange-alt"></i>
                        </div>
                        <div class="header-title">
                            <h1>Wallet to Bank</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Wallet to Bank</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12 col-md-10 col-lg-8">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12 col-md-10 col-lg-8">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } ?>
                        <div class='modal fade' id='referral_Modal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Referral Lead</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input type="hidden" id="modalAmount" name="amount">
                                            <input type="hidden" id="modalPin" name="trans_pin">
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>How did you hear about us?</label>
                                                <select required="" class="form-control" name="referral">
                                                    <optgroup>
                                                        <option selected></option>
                                                        <option>Friends / Family</option>
                                                        <option>Social Media</option>
                                                        <option>Personality Endorsement</option>
                                                        <option>Others (please specify)</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Please specify</label>
                                                <input type="text" name="others" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>
                                            <button type='submit' name='referral_submit' class='btn btn-success'>Confirm Transfer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-10 col-lg-8">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Transfer Money from Wallet to Bank Account</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                        <p>Please ensure that the bank account information set on your profile is accurate as it is the intending beneficiary account for this transaction. This transaction will require Admin approval!<br/><br/>Requests made on or before 10:00hrs GMT+1 of Tuesdays or Thursdays will be processed same day. Subsequent ones will be effected on the following Tuesday or Thursday as the case may be.<br/><br/>The MINIMUM amount to withdraw at any time is <b>&#8358; 40, 000</b><br/><br/><span style="color: #FFF;">N/B: A transfer fee of <?php echo $transfer_charge; ?> applies for this transaction</span></p><br/>
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Amount</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="amount" type="number" placeholder="Enter amount" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" autocomplete="new-password" name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button <?php if($referral_lead==null){ ?> type="button" onclick="return addAmount();" data-toggle="modal" data-target="#referral_Modal" <?php }else{ ?> type="submit" name="submit"  onclick="return confirm('Confirm transaction?')" <?php } ?>  class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>

                                        <hr style="margin-top: 100px;border:0px; border-top: 1px solid #555;" />
                                        <div class="col-xs-12" style="margin-top: 5px;margin-bottom: 20px;">
                                            <sup>**</sup> Our adopted exchange rate is &#8358; <?php echo $exchange1; ?> to $1 for all inflows and &#8358; <?php echo $exchange2; ?> to $1 for all outflows.<br/><br/>
                                            <span style="font-weight: bold;">N/B: </span>Please contact us for other currency exchange rates.
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Transaction History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Bank</th>
                                                    <th>Acct. Name</th>
                                                    <th>Acct. Number</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date Posted</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo walletBankHistory($user_id); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
