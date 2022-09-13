<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php"; 

    $query = selectPDO("select * from users where roles is not NULL and email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/index");
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
        <title>Administrator | Blackloop Club</title>
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
                    <?php if(validateSideAdmin(1)){ ?>
                    <div class="row">
                        <h1 class="text-center">EARNINGS</h1>
                        <hr/>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies ever received in the system from the beginning">
                            <div class="statistic-box statistic-filled-4">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalEarnings(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Earnings</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies in the system jointly owned by the company and clients">
                            <div class="statistic-box statistic-filled-3">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(currentEarnings(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Current Earnings</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies taken out of the system by clients">
                            <div class="statistic-box statistic-filled-4">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalPayouts(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Payouts</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies in the system due to clients">
                            <div class="statistic-box statistic-filled-2">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(outstandingPayouts(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Payouts</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies in the system ever owned by the company, including amounts withdrawn in the past">
                            <div class="statistic-box statistic-filled-4">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(grossEarnings(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Gross Earnings</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All monies in the system owned by only the company">
                            <div class="statistic-box statistic-filled-1">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(netEarnings(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Net Earnings</div>
                                <i class="ti-world statistic_icon fab fa-bitcoin"></i>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <h1 class="text-center">OUTSTANDINGS</h1>
                        <hr/>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-1">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(outstandingWallet(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Wallets</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-3">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(outstandingVoucher(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Vouchers</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-2">
                                <h3><span class="count-number"><?php echo number_format(outstandingCar()); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Cars</div>
                                <i class="ti-world statistic_icon fa fa-car"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(outstandingHouse()); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Houses</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
                        </div>

                    </div>
                    <?php } if(validateSideAdmin(2)){ ?>
                    <div class="row">
                        <h1 class="text-center">USERS</h1>
                        <hr/>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-1">
                                <h3><span class="count-number"><?php echo number_format(totalActive()); ?></span></h3>
                                <div class="big" style="font-weight: bold">Active Users</div>
                                <i class="ti-world statistic_icon fa fa-users"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-3">
                                <h3><span class="count-number"><?php echo number_format(totalPending()); ?></span></h3>
                                <div class="big" style="font-weight: bold">Pending Users</div>
                                <i class="ti-world statistic_icon fa fa-user-plus"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                            <div class="statistic-box statistic-filled-2">
                                <h3><span class="count-number"><?php echo number_format(totalAdmin()); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Admins</div>
                                <i class="ti-world statistic_icon fa fa-user-secret"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(1)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 1</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(2)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 2</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(3)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 3</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(4)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 4</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(5)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 5</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(6)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 6</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel(7)); ?></span></h3>
                                <div class="big" style="font-weight: bold">Level 7</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalLevel("exclusive")); ?></span></h3>
                                <div class="big" style="font-weight: bold">Exclusive</div>
                                <i class="ti-world statistic_icon fa fa-level-up-alt"></i>
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
                    toastr.success('Blackloop Club Admin Dashboard', 'Welcome!');

                }, 1300);
            });
        </script>
    </body>
</html>
