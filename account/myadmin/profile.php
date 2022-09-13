<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php";

    $query = selectPDO("select * from users where roles is not NULL and email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    if($query->rowCount()==0){
        header("Location: {$GLOBALS['path']}account/index");
        exit;
    } 

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['update_profile'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $date = date("Y-m-d H:i:s");
        $user = array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][1], $fname, $lname, $_SESSION['blackloop_slug'][4], $_SESSION['blackloop_slug'][5]);
            $_SESSION['blackloop_slug'] = $user;
        otherPDO("update users set fname=?, lname=?, date_modified=? where id = ?",array($fname, $lname, $date, $admin_id));
        $success = "Update was successful!";
        
    }

    if(isset($_POST['set_pin'])){
        $trans_pin = $_POST['trans_pin'];
        $trans_pin2 = $_POST['trans_pin2'];
        $date = date("Y-m-d H:i:s");

        if(is_numeric($trans_pin)){
            if(strlen($trans_pin)!=4){
                $error = "Transaction PIN must be 4 characters long!";
            }else{
                if($trans_pin != $trans_pin2){
                    $error = "Transaction PIN does not match!";
                }else{
                    $hash = password_hash($trans_pin, PASSWORD_BCRYPT);
                    otherPDO("update users set user_pin = ?, date_modified = ? where id = ?", array($hash, $date, $admin_id));
                    $success = "Transaction PIN was set successfully";
                }
            }
        }else{
            $error = "Transaction PIN must be numeric characters!";
        }
    }

    if(isset($_POST['reset_pin'])){
        $old_pin = $_POST['old_pin'];
        $trans_pin = $_POST['trans_pin'];
        $trans_pin2 = $_POST['trans_pin2'];
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $pin = $row['user_pin'];

        if(!password_verify($old_pin, $pin)){
            $error = "Old PIN does not match!";
        }else{
            if(is_numeric($trans_pin)){
                if(strlen($trans_pin)!=4){
                    $error = "Transaction PIN must be 4 characters long!";
                }else{
                    if($trans_pin != $trans_pin2){
                        $error = "Transaction PIN does not match!";
                    }else{
                        $hash = password_hash($trans_pin, PASSWORD_BCRYPT);
                        otherPDO("update users set user_pin = ?, date_modified = ? where id = ?", array($hash, $date, $admin_id));
                        $success = "Transaction PIN has been reset successfully";
                    }
                }
            }else{
                $error = "Transaction PIN must be numeric characters!";
            }
        }
    }

    if(isset($_GET['x'])){ // set PIN
        $query = selectPDO("select * from users where id = ?", array($admin_id));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        if($row['user_pin']==NULL){
            $set_PIN = "";
        }else{
            $reset_PIN = "";
        }
    }

    if(isset($_GET['y'])){ // set PIN
        $query = selectPDO("select * from users where id = ?", array($admin_id));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        if($row['user_pin']!=NULL){
            $reset_PIN = "";
        }else{
            $set_PIN = "";
        }
    }

    if(isset($_GET['rp'])){ // reset password
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
        $success = "Password reset link has been sent successfully! Please set new password and login again.";
    }

    $query = selectPDO("select * from users where id = ?", array($admin_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $user_pin = $row['user_pin'];
        $date_registered = date("D, j M Y g:i a", strtotime($row['date_registered']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        $last_online = date("D, j M Y g:i a", strtotime($row['last_online']));
        if($row['user_status']=="1"){
            $status="<span class='label label-pill label-success-outline m-r-15'>Active</span>";
        }elseif($row['user_status']=="0"){
            $status="<span class='label label-pill label-primary-outline m-r-15'>Pending</span>";
        }elseif($row['user_status']=="2"){
            $status="<span class='label label-pill label-warning-outline m-r-15'>Disabled</span>";
        }
        $query2 = selectPDO("select * from roles where id = ?", array($row['roles']));
        $row2=$query2->fetch(PDO::FETCH_ASSOC);
        $role = ucfirst($row2['category']);
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
        <title>My Profile | Blackloop Club</title>
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
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <div class="header-title">
                            <h1>My Profile</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } if(isset($set_PIN)){ ?>
                        <div class="col-xs-12" style="padding: 0px;">
                            <form action="" method="post">
                                <div class="col-xs-12 col-md-6">
                                    <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;padding: 10px;cursor: text;">Set Transaction PIN</h2>
                                    <div class="panel panel-bd">
                                        
                                        <div class="panel-body">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label class="control-label">Enter PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="username" required="" type="password" class="form-control" name="trans_pin" placeholder="Enter PIN">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Re-enter PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="username" required="" type="password" class="form-control" name="trans_pin2" placeholder="Re-enter PIN">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="profile"><button type='button' class='btn btn-danger'>Close</button></a>
                                                    <button type="submit" name="set_pin" class="btn btn-primary pull-right">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <?php }elseif(isset($reset_PIN)){ ?>
                        <div class="col-xs-12" style="padding: 0px;">
                            <form action="" method="post">
                                <div class="col-xs-12 col-md-6">
                                    <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;padding: 10px;cursor: text;">Reset Transaction PIN</h2>
                                    <div class="panel panel-bd">
                                        
                                        <div class="panel-body">
                                            <form action="" method="post">
                                                <div class="form-group">
                                                    <label class="control-label">Enter Old PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="username" required="" type="password" class="form-control" name="old_pin" placeholder="Enter Old PIN">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Enter PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="username" required="" type="password" class="form-control" name="trans_pin" placeholder="Enter New PIN">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Re-enter PIN</label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                        <input id="username" required="" type="password" class="form-control" name="trans_pin2" placeholder="Re-enter New PIN">
                                                    </div>
                                                </div>
                                                <div>
                                                    <a href="profile"><button type='button' class='btn btn-danger'>Close</button></a>
                                                    <button type="submit" name="reset_pin" class="btn btn-primary pull-right">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <?php } ?>
                        <div class="col-xs-12" style="padding: 0px;">
                            <div class="col-xs-12 col-md-6">
                                <div class='card col-xs-12' style='padding: 0px;margin-bottom: 50px;'>
                                    <div class='card-header' style='background: #FFF;padding: 0px;'>
                                        <img src='../../img/default-user.png'  style='margin-left: 2px;margin-bottom: -2px;' />
                                    </div>
                                    <div class='card-content'>
                                        <div class='card-content-member'>
                                            <h4 class='m-t-0'><?php echo $fname." ".$lname; ?></h4>
                                            <p><?php echo $role; ?> Privileges</p>
                                            <p><?php echo $status; ?></p>
                                        </div>
                                        <div class='card-content-languages'>
                                            <div class='card-content-languages-group'>
                                                <div>
                                                    <h4>Email:</h4>
                                                </div>
                                                <div>
                                                    <ul>
                                                        <li style="word-wrap: break-word;table-layout: fixed;width: 200px;"><?php echo $email; ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class='card-content-languages-group'>
                                                <div>
                                                    <h4>Password:</h4>
                                                </div>
                                                <div>
                                                    <ul>
                                                        <li><a onclick="return confirm('Reset admin password?');" href='?rp'>Reset Password</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class='card-content-languages-group'>
                                                <div>
                                                    <h4>Trans PIN:</h4>
                                                </div>
                                                <div>
                                                    <ul>
                                                        <li><a <?php if($user_pin==NULL){ ?> href='?x'>Set PIN</a> 
                                                            <?php }else{ ?> href='?y'>Reset PIN</a> <?php } ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='card-footer'>
                                        <div class='card-footer-stats'>
                                            <div>
                                                <p>DATE <br/>REGISTERED:</p><br/><span class='stats-small'><?php echo $date_registered; ?></span>
                                            </div>
                                            <div>
                                                <p>LAST <br/>MODIFIED:</p><br/><span class='stats-small'><?php echo $date_modified; ?></span>
                                            </div>
                                            <div>
                                                <p>LAST <br/>ONLINE</p><br/><span class='stats-small'><?php echo $last_online; ?></span>
                                            </div>
                                        </div>
                                        <div data-toggle="modal" data-target="#editProfileModal
                                        " class="card-footer-message btn btn-success col-xs-12">
                                            <h4><i class="fa fa-edit"></i> Edit Profile</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='modal fade' id='editProfileModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Update Profile</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $fname; ?>" name="fname" placeholder="Enter first name" class="form-control">

                                            <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $lname; ?>" name="lname" placeholder="Enter last name" class="form-control">

                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' name='update_profile' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
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
