<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateAdmin(1);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['submit'])){
        $amount = $_POST['amount'];
        $note = $_POST['note'];
        $trans_pin = $_POST['fakepasswordremembered'];
        $email = $_POST['email'];
        $email_list = explode(PHP_EOL, $email);
        $email_size = count($email_list);
        $payment_type = strtolower($_POST['payment_type']);
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }elseif($amount>0){
            $beneficiary_id = array(); $error = array();
            for($i=0; $i<$email_size; $i++){
                $query = selectPDO("select * from users where email = ? and user_status = '1' and roles is NULL", array($email_list[$i]));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $beneficiary_id[] = $row['id'];
                    $beneficiary_email[] = $email_list[$i];
                }
                if($query->rowCount()==0){
                    $error[] = $email_list[$i];
                }
            }

            if(count($error)==0){
                $size = count($beneficiary_id);
                $total_amount = $amount * $size;
                if($total_amount <= netEarnings()){
                    for($i=0; $i<$size; $i++){
                        $query = selectPDO("select * from accounts where user_id = ?", array($beneficiary_id[$i]));
                        while($row=$query->fetch(PDO::FETCH_ASSOC)){
                            $beneficiary_bal = $row['wallet_bal']+$amount;
                        }

                        //update transaction for sender
                        otherPDO("insert into withdrawals (amount, type, note, admin, beneficiary, date_posted) values (?,?,?,?,?,?)", array($amount, $payment_type, $note, $admin_id, $beneficiary_email[$i], $date));

                        //update transaction for beneficiary
                        otherPDO("update accounts set wallet_bal = ?, date_modified = ? where user_id = ?", array($beneficiary_bal, $date, $beneficiary_id[$i]));

                        otherPDO("insert into payouts (user_id, type, amount, referrals_id, date_posted) values (?,?,?,?,?)", array($beneficiary_id[$i], $payment_type, $amount, $admin_id, $date));

                        // notify beneficiary
                        sendNotification($beneficiary_id[$i], $payment_type, $amount, $beneficiary_bal, "", "");
                    }


                    $success = "Direct payment was successfully to {$size} users!";
                }else{
                    $error = "Sorry, your Net Earnings is insufficient to support this transaction!";
                }
            }else{
                $nums = "";
                foreach($error as $key => $value){
                    $nums.=$value.", ";
                }
                if(substr($nums, -2)==", "){$nums = substr($nums, 0, -2);}
                $error = "The following email addresses do not belong to active registered members:<br/>{$nums}";
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
        <title>Direct Pay | Blackloop Club</title>
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
                         <?php require_once "../news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fab fa-bitcoin"></i>
                        </div>
                        <div class="header-title">
                            <h1>Direct Pay</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Direct Pay</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies taken out of the system by the company">
                            <div class="statistic-box statistic-filled-1">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalCompanyCashouts(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Withdrawals</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies taken out of the system by the company for personal use">
                            <div class="statistic-box statistic-filled-3">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalSelfWithdrawals(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Self Withdrawals</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies taken out of the system by the company for third party">
                            <div class="statistic-box statistic-filled-4">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalOtherPartyWithdrawals(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Third Party Withdrawals</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
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
                                        <h4>Pay User Directly</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Amount</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="amount" type="number" placeholder="Enter amount" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Beneficiary Email(s), one per line</label>
                                            <div class="col-sm-7">
                                                <textarea rows="5" class="form-control" required placeholder="Enter beneficiary email(s), one per line" name="email"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Payment Type</label>
                                            <div class="col-sm-7">
                                                <select id="payment_type" class="form-control" name="payment_type">
                                                    <optgroup>
                                                        <option disabled selected></option>
                                                        <option>Bonus</option>
                                                        <option>Refund</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Description</label>
                                            <div class="col-sm-7">
                                                <textarea class="form-control" name="note"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" autocomplete="new-password"  name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="submit" onclick="return checkPayment();" class="btn btn-labeled btn-success m-b-5 ">
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
                                        <h4>Total Direct Pay History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Amount</th>
                                                    <th>Beneficiary</th>
                                                    <th>Note</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo totalDirectPayHistory(); ?>
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
