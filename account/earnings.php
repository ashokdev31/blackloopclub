<?php 
    require_once "../functions_basic.php";
    require_once "validation.php";

    validateUser();
    restrictUserTotalTop();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    $query = selectPDO("select * from accounts where user_id = ?", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $wallet_bal = $row['wallet_bal'];
        $voucher_bal = $row['voucher_bal'];
        $car = $row['car'];
        $house = $row['house'];
    }

    $query = selectPDO("select * from page_details where name = 'earnings'", array());
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $earnings_note = $row['note'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>My Earnings | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            
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
                            <i class="fab fa-bitcoin"></i>
                        </div>
                        <div class="header-title">
                            <h1>My Earnings</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">My Earnings</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-1">
                                <h3>&#8358; <span class="count-number"><?php echo number_format($wallet_bal, 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Wallet Balance</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-3">
                                <h3>&#8358; <span class="count-number"><?php echo number_format($voucher_bal, 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Shopping Voucher</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-2">
                                <h3><span class="count-number"><?php echo number_format($car); ?></span></h3>
                                <div class="big" style="font-weight: bold">Car Bonus</div>
                                <i class="ti-world statistic_icon fa fa-car"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format($house); ?></span></h3>
                                <div class="big" style="font-weight: bold">House Bonus</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Multiple panels with drag & drop -->
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Explaining Our Compensation Plan</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <?php echo $earnings_note; ?>
                                </div>
                                <div class="panel-footer">
                                    <a href="<?php echo $GLOBALS['path'] ?>exponential-giveback-plan" target="_blank">Visit Exponential Giveback Plan</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Earnings History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo earningsHistory($user_id); ?>
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
