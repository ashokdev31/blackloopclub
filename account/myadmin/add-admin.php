<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php"; 

    validateAdmin(1);

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $role = $_POST['roles'];
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where email = ?", array($email));
        if($query->rowCount()>0){
            $error = "Email is already in use!";
        }else{
            $hash = password_hash(date("YmdHis"), PASSWORD_BCRYPT);
            $email_hash = password_hash($email, PASSWORD_BCRYPT);
            otherPDO("insert into users (fname, lname, email, email_slug, roles, password, date_registered, date_modified) values (?,?,?,?,?,?,?,?)", array($fname, $lname, $email, $email_hash, $role, $hash, $date, $date));

            // send message
            $link = "https://www.blackloopclub.com/set-password?m={$email_hash}&x={$hash}";
            $to      = $email;
            $subject = "Create Your Account Password!";
            $message = "Dear {$fname},<br/><br/>Your admin profile on Blackloop Club has been created! Please click <a href='{$link}'>HERE</a> to set your admin password.<br/><br/><br/>Blackloop Club Team";
            $message = wordwrap($message, 70, "\r\n");
            $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                        'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                    'Reply-To: contact@blackloopclub.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            $success = "Admin account created successfully!";
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
        <title>Create New Admin | Blackloop Club</title>
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
                         <?php require_once "../news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="header-title">
                            <h1>Create New Admin</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Create New Admin</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="row">
                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12 col-sm-8 col-md-6">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    <div class="panel panel-bd col-xs-12 col-sm-8 col-md-6">
                        <div class="panel-body">
                            <form action="" method="post">
                                <!--Social Buttons--> 
                                
                                <div class="form-group">
                                    <label class="control-label">Firstname</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" required="" type="text" class="form-control" name="fname" placeholder="Please enter firstname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Lastname</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="username" required="" type="text" class="form-control" name="lname" placeholder="Please enter lastname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                        <input id="email" required="" type="email" class="form-control" name="email" placeholder="Please enter email adress">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Admin Roles</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fab fa-expeditedssl"></i></span>
                                        <select name="roles" class="form-control">
                                            <optgroup>
                                                <?php echo getRoles(); ?>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
