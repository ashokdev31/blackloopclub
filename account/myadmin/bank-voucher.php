<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateAdmin(3);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
        $user_code = $row['user_code'];
    }

    if(isset($_POST['update_transfer'])){
        $transfer_id = $_POST['transfer_id'];
        $user_id = $_POST['user_id'];
        $status = $_POST['status'];
        $remarks = $_POST['remarks'];
        $date = date("Y-m-d H:i:s");
        $new_bal = $_POST['new_bal'];
        $request_amt = $_POST['request_amt'];
        $request_amt2 = $_POST['request_amt2'];

        // update user's account
        otherPDO("update accounts set voucher_bal = ? where user_id = ?", array($new_bal, $user_id));

        otherPDO("insert into payouts (user_id, type, amount, date_posted) values (?,?,?,?)", array($user_id, "deposit", $request_amt2, $date));

        otherPDO("update transfers set transfer_status = ?, remarks = ?, date_modified = ?, admin = ? where id = ?", array($status, $remarks, $date, $admin_id, $transfer_id));

        // update company's account
        otherPDO("insert into bank_inflow (user_id, amount, date_posted) values (?,?,?)", array($user_id, $request_amt2, $date));
        
        // send notification
        $notification_type = "transfer";
        $type = "Bank to Voucher";
        $ids = array($user_id, $type);
        sendNotification($ids, $notification_type, $request_amt, "", "", "");

        $success = "Transfer request has been updated!";
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
                         <?php require_once "../news-flash.php"; ?>
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
                        
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Manage Bank to Voucher Transfer Requests</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Bank Info</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Date Posted</th>
                                                    <th>Date Modified</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo bankVoucherTrans(); ?>
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
