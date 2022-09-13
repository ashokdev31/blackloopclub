<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    if(isset($_POST['deactivate'])){
        $date = date("Y-m-d H:i:s");
        otherPDO("update users set user_status = '3', date_modified = ? where id = ?", array($date, $user_id));
        otherPDO("insert into deactivation_reviews (user_id, review, date_posted) values (?,?,?)", array($user_id, $_POST['review'], $date));
        // log out user
        // send email
        header("Location: ../index");
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
        <title>Deactivate Account | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .panel-footer button {
                float: right;
            }

            @media (max-width: 767px){
                .panel-footer button {
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
                            <i class="fa fa-times-circle"></i>
                        </div>
                        <div class="header-title">
                            <h1>Deactivate Account</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Deactivate Account</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Danger Panel -->
                            <div class="panel panel-danger lobidisable">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4><span class="fa fa-exclamation-triangle"></span> Warning!</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                <div class="panel-body">
                                    <p>Continuing with this action will permanently block you from our system. This means that you will no longer be able to log in, earn bonuses, make withdrawals, shop with our cards, receive email newsletters, carry out any Blackloop Club related transactions or enjoy any benefits.</p>
                                    <p>Every other third party services linked to this account will also be discontinued at no liability to us. Please be sure that you really want to continue with this action before confirming with the proceed button below.</p>
                                    <br/>
                                    <label>Please leave a review:</label>
                                    <input type="text" placeholder="Tell us why you are leaving" name="review" class="form-control">
                                </div>
                                <div class="panel-footer" style="height: 60px;">
                                    <button type="submit" name="deactivate" onclick="return confirm('Confirm account de-activation? This action CANNOT be undone!');" class="btn btn-labeled btn-danger m-b-5">
                                        <span class="btn-label"><i class="fa fa-exclamation-triangle"></i></span>Proceed
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
