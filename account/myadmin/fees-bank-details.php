<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php";

    validateAdmin(1);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['submit'])){
        $bank_name = $_POST['bank_name'];
        $acct_name = $_POST['acct_name'];
        $acct_number = $_POST['acct_number'];
        $acct_type = $_POST['acct_type'];
        $swift_code = $_POST['swift_code'];
        $trans_pin = $_POST['fakepasswordremembered'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            otherPDO("insert into bank_accounts (bank_name, acct_name, acct_number, acct_type, swift_code) values (?,?,?,?,?)", array($bank_name, $acct_name, $acct_number, $acct_type, $swift_code));

            $success = "New account added successfully!";
                
        }
    }

    if(isset($_POST['update_bank'])){
        $bank_name = $_POST['bank_name'];
        $acct_name = $_POST['acct_name'];
        $acct_number = $_POST['acct_number'];
        $acct_type = $_POST['acct_type'];
        $swift_code = $_POST['swift_code'];
        $trans_pin = $_POST['fakepasswordremembered'];
        $bank_id = $_POST['bank_id'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            otherPDO("update bank_accounts set bank_name=?, acct_name=?, acct_number=?, acct_type=?, swift_code=? where id = ?", array($bank_name, $acct_name, $acct_number, $acct_type, $swift_code, $bank_id));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_POST['update_fees'])){
        $privilege = $_POST['privilege'];
        $premium = $_POST['premium'];
        $exchange = $_POST['exchange'];
        $bank = $_POST['wallet_bank'];
        $to_voucher = $_POST['bank_voucher'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            // privilege
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'privilege'", array($privilege, $exchange));

            // privilege
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'premium'", array($premium, $exchange));

            // bank
            otherPDO("update payout_settings set amount=? where type = 'bank'", array($bank));

            // to_voucher
            otherPDO("update payout_settings set amount=? where type = 'to_voucher'", array($to_voucher));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_GET['del'])){
        otherPDO("delete from bank_accounts where id = ?", array($_GET['del']));
        $success = "Account entry has been deleted!";
    }

    $query = selectPDO("select * from payout_settings", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        if($row['type']=="privilege"){
            $privilege = $row['amount'];
            $exchange = $row['exchange'];
        }

        if($row['type']=="premium"){
            $premium = $row['amount'];
        } 

        if($row['type']=="bank"){
            $bank = $row['amount'];
        }

        if($row['type']=="to_voucher"){
            $to_voucher = $row['amount'];
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
        <title>Fees & Bank Details | Blackloop Club</title>
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
                            <i class="fa fa-cog"></i>
                        </div>
                        <div class="header-title">
                            <h1>Fees & Bank Details</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Fees & Bank Details</li>
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
                        <div class="col-xs-12 col-md-6">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Add New Bank Account</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Bank Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="bank_name" type="text" placeholder="Enter bank name" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Account Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="acct_name" type="text" placeholder="Enter account name" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Account Number</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="acct_number" type="number" placeholder="Enter account number" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Account Type</label>
                                            <div class="col-sm-7">
                                                <select id="account_type" class="form-control" name="acct_type">
                                                    <optgroup>
                                                        <option disabled selected></option>
                                                        <option>Current</option>
                                                        <option>Savings</option>
                                                        <option>Dollar</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Swift Code</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" name="swift_code" type="text" placeholder="Enter swift code">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" autocomplete="new-password" required="" name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="submit" onclick="return checkBank();" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-6">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Fees & Charges</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Privilege Membership Fee ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $privilege; ?>" name="privilege" type="number" placeholder="Privilege membership" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Premium Membership Fee ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $premium; ?>" name="premium" type="number" placeholder="Premium membership" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Exchange Rate (&#8358;)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $exchange; ?>" name="exchange" type="number" placeholder="Exchange rate" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Wallet to Bank Charge (%)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $bank; ?>" name="wallet_bank" type="text" placeholder="Wallet to bank charge" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Bank to Voucher Charge (%)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" name="bank_voucher" value="<?php echo $to_voucher; ?>" type="text" placeholder="Bank to voucher charge">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" name="trans_pin" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_fees" onclick="return confirm('Confirm changes?')" class="btn btn-labeled btn-success m-b-5 ">
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
                                        <h4>All Bank Accounts </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Bank Name</th>
                                                    <th>Account Name</th>
                                                    <th>Account Number</th>
                                                    <th>Account Type</th>
                                                    <th>Swift Code</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo allBankAccounts(); ?>
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
