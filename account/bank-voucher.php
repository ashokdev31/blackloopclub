<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();
    restrictUserTotalTop();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    $query = selectPDO("select * from payout_settings where type = 'to_voucher'", array());
    $row=$query->fetch(PDO::FETCH_ASSOC);
    $transfer_charge = $row['amount']."%";


    if(isset($_POST['submit'])){
        $amount = $_POST['amount'];
        $trans_pin = $_POST['fakepasswordremembered'];
        $payer_name = $_POST['payer_name'];
        $trans_date = $_POST['trans_date'];
        $bank_info = $_POST['bank_info'];
        $query=selectPDO("select * from bank_accounts where id = ?", array($bank_info));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $bank_name = $row['bank_name'];
        $acct_name = $row['acct_name'];
        $acct_number = $row['acct_number'];
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $pin = $row['user_pin'];

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{

            otherPDO("insert into transfers (user_id, bank_name, acct_name, acct_number, amount, trans_date, payer_name, type, date_posted, date_modified) values (?,?,?,?,?,?,?,?,?,?)", array($user_id, $bank_name, $acct_name, $acct_number, $amount, $trans_date, $payer_name, "bank_voucher", $date, $date));
            $success = "Transfer request submitted successfully!";
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
        <title>Bank to Voucher | Blackloop Club</title>
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
                            <h1>Bank to Voucher</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Bank to Voucher</li>
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
                        
                        <div class="col-xs-12 col-lg-6">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Deposit Money to Voucher</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body" style="background: rgba(255,255,255,.1);">
                                        <p>You can deposit money into any of our bank accounts and have the value credited to your shopping voucher by providing details of the transaction in the form below. This transaction will require Admin approval!<br/><br/><span style="color: #FFF;">N/B: A transfer fee of <?php echo $transfer_charge; ?> applies for this transaction</span></p><br/>
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Amount</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="amount" type="number" placeholder="Enter amount" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Payment Info</label>
                                            <div class="col-sm-7">
                                                <select id="bank_info" name="bank_info" required class="form-control">
                                                    <optgroup label="">
                                                        <option disabled selected></option>
                                                        <?php echo listBankAccount(); ?>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Payer's Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="payer_name" type="text" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction Date</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="trans_date" type="date" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" autocomplete="new-password" required="" name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button type="submit" name="submit"  onclick="return checkAccount();" class="btn btn-labeled btn-success m-b-5 ">
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

                        <div class="col-xs-12 col-lg-6">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Our Bank Information</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body" style="background: rgba(255,255,255,.1);">
                                        <?php echo bankInfo(); ?>                                       
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
                                                    <th>Bank Info</th>
                                                    <th>Payer's Name</th>
                                                    <th>Trans. Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date Posted</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo bankVoucherHistory($user_id); ?>
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
