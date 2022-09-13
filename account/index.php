<?php 
    require_once "../functions_basic.php"; 
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $level = $row['user_level'];
        $user_id = $row['id'];
        $date_shifted = $row['date_shifted'];
        $user_code = $row['user_code'];
        $user_status = $row['user_status'];
    }

    $query = selectPDO("select * from users where user_status = '1' and date_shifted > ? and user_level = '1'", array($date_shifted));
    $shifts = $query->rowCount();

    $query = selectPDO("select * from accounts where user_id = ?", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $wallet_bal = $row['wallet_bal'];
        $voucher_bal = $row['voucher_bal'];
        $car = $row['car'];
        $house = $row['house'];
    }

    $query = selectPDO("select * from payments where user_id = ? order by date_posted desc", array($user_id));
    $payment_size = $query->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Dashboard | Blackloop Club</title>
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
                         <?php require_once "news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-tachometer-alt"></i>
                        </div>
                        <div class="header-title">
                            <h1>Welcome to your dashboard</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        
                        <?php if($user_status==0){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> Your payment is undergoing review, please allow some time for this to be completed before your account can become active!</div>
                        </div>
                        <?php }elseif($user_status==2 && $payment_size==0){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> You are yet to make any payment! Kindly use <b><?php echo $user_code; ?></b> as your Blackloop Clup Usercode to make payment via any of the GT Collections channels of Guaranteed Trust Bank Plc or go to My Profile and scroll down to Payments and click on Add New Payment to use other payment options.</div>
                        </div>
                        <?php }elseif($user_status==2){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> Please complete payment for your account to become active! Your previous payment was either declined or partially approved, go to My Profile and click on Add Payment to make a new payment.</div>
                        </div>
                        <?php }elseif($user_status==4){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> This account is now restricted! You are advised to make a transfer request for your money in the wallet to be transfered to your updated bank account in your profile for your refund to be completed. Go to Transactions and click on Wallet to Bank to proceed.</div>
                        </div>
                        <?php } ?>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-3">
                                <h2><span class=""><?php echo $level; ?></span> <span class="slight"><i class="fa fa-play fa-rotate-270 text-warning" title="Number of new members since you last moved to a new level"> </i> <?php echo number_format($shifts); ?> shifts</span></h2>
                                <div class="big" style="font-weight: bold">Current Level</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-1">
                                <h2>&#8358; <span class="count-number"><?php echo number_format($wallet_bal, 2); ?></span></h2>
                                <div class="big" style="font-weight: bold">Wallet Balance</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-2">
                                <h2>&#8358; <span class="count-number"><?php echo number_format($voucher_bal, 2); ?></span></h2>
                                <div class="big" style="font-weight: bold">Shopping Voucher</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                    </div>
                    <?php if(restrictUserTotal()){ ?>
                    <div class="row">

                        <div class="col-xs-12">
                            <!-- Info Panel -->
                            <div class="panel panel-inverse lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Referral Link</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class='form-group'>
                                        <label for='exampleSelect1'>Referral Link</label>
                                        <input type="text" readonly="" id="refCode2" value="https://www.blackloopclub.com/register?ref_code=<?php echo $user_code; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" onclick="copyRef2();" class="btn btn-labeled btn-info m-b-5     toastr2">
                                        <span class="btn-label"><i class="fa fa-copy"></i></span>Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                "use strict"; // Start of use strict

                // notification
                setTimeout(function () {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                                // positionClass: "toast-top-left"
                    };
                    toastr.success('Blackloop Club Membership Dashboard', 'Welcome!');

                }, 1300);
            });
        </script>
    </body>
</html>
