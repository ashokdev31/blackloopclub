<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php";

    validateAdmin(1); 

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['update_payouts'])){
        $level1 = $_POST['level1'];
        $level2 = $_POST['level2'];
        $level3 = $_POST['level3'];
        $level4 = $_POST['level4'];
        $level5 = $_POST['level5'];
        $level6 = $_POST['level6'];
        $level7 = $_POST['level7'];
        $referral_bonus = $_POST['referral_bonus'];
        $sellerator_bonus = $_POST['sellerator_bonus'];
        $shopping_bonus = $_POST['shopping_bonus'];
        $exchange = $_POST['exchange'];
        $shopping_ref = $_POST['shopping_ref'];
        $car_ref = $_POST['car_ref'];
        $house_ref = $_POST['house_ref'];
        $car_value = $_POST['car_value'];
        $house_value = $_POST['house_value'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            // level 1
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='1'", array($level1, $exchange));

            // level 2
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='2'", array($level2, $exchange));

            // level 3
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='3'", array($level3, $exchange));

            // level 4
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='4'", array($level4, $exchange));

            // level 5
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='5'", array($level5, $exchange));

            // level 6
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='6'", array($level6, $exchange));

            // level 7
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'level' and level='7'", array($level7, $exchange));

            // shopping bonus
            otherPDO("update payout_settings set amount=?, exchange=? where type = 'shopping_bonus'", array($shopping_bonus, $exchange));

            // referral bonus
            otherPDO("update payout_settings set amount=? where type = 'referral'", array($referral_bonus));

            // sellerator bonus
            otherPDO("update payout_settings set amount=? where type = 'sellerator'", array($sellerator_bonus));

            // shopping referral
            otherPDO("update payout_settings set amount=? where type = 'shopping'", array($shopping_ref));

            // car referral
            otherPDO("update payout_settings set amount=? where type = 'car'", array($car_ref));

            // house referral
            otherPDO("update payout_settings set amount=? where type = 'house'", array($house_ref));

            // car value
            otherPDO("update value_chart set amount=?, exchange = ? where name = 'car'", array($car_value, $exchange));

            // house value
            otherPDO("update value_chart set amount=?, exchange = ? where name = 'house'", array($house_value, $exchange));

            $success = "Changes have been updated successfully!";
                
        }
    }


    $query = selectPDO("select * from payout_settings", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        if($row['type']=="level" and $row['level']==1){
            $level1 = $row['amount'];
            $exchange = $row['exchange'];
        }

        if($row['type']=="level" and $row['level']==2){
            $level2 = $row['amount'];
        }

        if($row['type']=="level" and $row['level']==3){
            $level3 = $row['amount'];
        }

        if($row['type']=="level" and $row['level']==4){
            $level4 = $row['amount'];
        }

        if($row['type']=="level" and $row['level']==5){
            $level5 = $row['amount'];
        }

        if($row['type']=="level" and $row['level']==6){
            $level6 = $row['amount'];
        }

        if($row['type']=="level" and $row['level']==7){
            $level7 = $row['amount'];
        }

        if($row['type']=="shopping_bonus"){
            $shopping_bonus = $row['amount'];
        }

        if($row['type']=="shopping"){
            $shopping_ref = $row['amount'];
        }

        if($row['type']=="car"){
            $car_ref = $row['amount'];
        }

        if($row['type']=="house"){
            $house_ref = $row['amount'];
        }

        if($row['type']=="referral"){
            $referral_bonus = $row['amount'];
        }

        if($row['type']=="sellerator"){
            $sellerator_bonus = $row['amount'];
        }

        
    }

    $query = selectPDO("select * from value_chart", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        if($row['name']=="car"){
            $car_value = $row['amount'];
            $exchange = $row['exchange'];
        }

        if($row['name']=="house"){
            $house_value = $row['amount'];
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
        <title>Payouts & Value Chart | Blackloop Club</title>
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
                            <h1>Payouts & Value Chart</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Payouts & Value Chart</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12 col-md-10">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12 col-md-10">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } ?>
                        <div class="col-xs-12 col-md-10">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Payouts, Bonuses & Value Chart</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 1 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level1; ?>" name="level1" type="number" placeholder="Level 1 bonus" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 2 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level2; ?>" name="level2" type="number" placeholder="Level 2 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 3 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level3; ?>" name="level3" type="number" placeholder="Level 3 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 4 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level4; ?>" name="level4" type="number" placeholder="Level 4 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 5 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level5; ?>" name="level5" type="number" placeholder="Level 5 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 6 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level6; ?>" name="level6" type="number" placeholder="Level 6 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Level 7 Payout ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $level7; ?>" name="level7" type="number" placeholder="Level 7 bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Referral Bonus (%)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $referral_bonus; ?>" name="referral_bonus" type="number" placeholder="Referral bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Sellerator Bonus ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $sellerator_bonus; ?>" name="sellerator_bonus" type="number" placeholder="Sellerator bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Shopping Bonus ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $shopping_bonus; ?>" name="shopping_bonus" type="number" placeholder="Shopping bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">No. of Referrals Required for Shopping Bonus</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $shopping_ref; ?>" name="shopping_ref" type="number" placeholder="Required referrals for shopping bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">No. of Referrals Required for Car Bonus</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $car_ref; ?>" name="car_ref" type="number" placeholder="Required referrals for car bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">No. of Referrals Required for House Bonus</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $house_ref; ?>" name="house_ref" type="number" placeholder="Required referrals for house bonus" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Monetary Value for Car ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $car_value; ?>" name="car_value" type="number" placeholder="Monetary value for car" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Monetary Value for House ($)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $house_value; ?>" name="house_value" type="number" placeholder="Monetary value for house" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Exchange Rate (&#8358;)</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" value="<?php echo $exchange; ?>" name="exchange" type="number" placeholder="Exchange rate" >
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" name="trans_pin" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_payouts" onclick="return confirm('Confirm changes?')" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
