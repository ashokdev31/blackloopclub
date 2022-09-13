<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();
    restrictUserTotalTop();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
        $user_code = $row['user_code'];
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
        }elseif($amount>0){

            $query = selectPDO("select * from users where user_code = ?", array($user_code));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $user_id = $row['id'];
            }

            $query = selectPDO("select * from accounts where user_id = ?", array($user_id));
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $wallet_bal = $row['wallet_bal'];
                $voucher_bal = $row['voucher_bal'];
            }

            if($wallet_bal >= $amount){
                $wallet_bal -= $amount;
                $voucher_bal += $amount;
                otherPDO("update accounts set wallet_bal = ?, voucher_bal = ?, date_modified = ? where user_id = ?", array($wallet_bal, $voucher_bal, $date, $user_id));

                otherPDO("insert into transfers (user_id, transfer_status, amount, type, date_posted, date_modified) values (?,?,?,?,?,?)", array($user_id, "1", $amount, "wallet_voucher", $date, $date));
                $success = "Transfer was successfully!";
            }else{
                $error = "Insufficient wallet balance!";
            }
        }else{
            $error = "Please enter an amount greater than zero!";
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
        <title>Wallet to Shopping Voucher | Blackloop Club</title>
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
                            <h1>Wallet to Shopping Voucher</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Wallet to Shopping Voucher</li>
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
                        
                        <div class="col-xs-12 col-md-10 col-lg-8">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Transfer Money from Wallet to Shopping Voucher</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                        <p>Monies sent to shopping voucher cannot be reversed and can only be used STRICTLY for shopping on the various Blackloop shopping platforms worldwide. This transaction is automatic!</p>
                                        
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

                                        <button type="submit" onclick="return confirm('Confirm transaction?')" name="submit" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
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
                                                    <th>Date Posted</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo walletVoucherHistory($user_id); ?>
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
