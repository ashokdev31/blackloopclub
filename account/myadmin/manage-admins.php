<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateAdmin(1);

    if(isset($_POST['update_admin'])){
        $status = $_POST['status'];
        $roles = $_POST['roles'];
        $admin_id = $_POST['admin_id'];

        otherPDO("update users set user_status = ?, roles = ? where id = ?", array($status, $roles, $admin_id));
        $success = "Changes saved successfully!";
    }

    if(isset($_GET['r'])){ // reset PIN
        $admin_id = $_GET['r'];
        otherPDO("update users set user_pin = ? where id = ?", array(NULL, $admin_id));
        $success = "User PIN has been reset successfully!";
    }

    if(isset($_GET['rp'])){ // reset password
        $admin_id = $_GET['rp'];
        $date = date("Y-m-d H:i:s");
        $hash = password_hash(date("YmdHis"), PASSWORD_BCRYPT);
        
        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $email = $row['email'];
            $email_slug = $row['email_slug'];
            $fname = $row['fname'];
        }
        otherPDO("update users set password = ?, date_modified = ? where id = ?", array($hash, $date, $admin_id));

        // send message
        $link = "https://www.blackloopclub.com/reset-password?m={$email_slug}&x={$hash}";
        $to      = $email;
        $subject = "Reset Your Account Password!";
        $message = "Dear {$fname},<br/><br/>Please click <a href='{$link}'>HERE</a> to set your admin password.<br/><br/><br/>Blackloop Club Team";
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                    'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                    'Reply-To: contact@blackloopclub.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        $success = "Password reset link has been sent successfully!";
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
        <title>Manage Admins | Blackloop Club</title>
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
                            <i class="fa fa-user-secret"></i>
                        </div>
                        <div class="header-title">
                            <h1>Manage Admins</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Manage Admins</li>
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
                                        <h4>Manage All Admins </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="user_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Names</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Role</th>
                                                    <th>Registered</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo showAdmins(); ?>
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
