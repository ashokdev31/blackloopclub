<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php";

    validateAdmin(1);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['add_tag'])){
        $name = $_POST['name'];
        $color = $_POST['color'];
        $trans_pin = $_POST['fakepasswordremembered'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            otherPDO("insert into news_tags (name, color) values (?,?)", array($name, $color));

            $success = "New tag added successfully!";
                
        }
    }

    if(isset($_POST['update_tag'])){
        $name = $_POST['name'];
        $color = $_POST['color'];
        $trans_pin = $_POST['fakepasswordremembered'];
        $tag_id = $_POST['tag_id'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            otherPDO("update news_tags set name=?, color=? where id = ?", array($name, $color, $tag_id));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_POST['update_exponential'])){
        $message = $_POST['earnings'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            // privilege
            otherPDO("update page_details set note=? where name = 'earnings'", array($message));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_POST['update_registration'])){
        $message = $_POST['registration'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            // privilege
            otherPDO("update page_details set note=? where name = 'after_register'", array($message));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_POST['update_payment'])){
        $message = $_POST['payment'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            // privilege
            otherPDO("update page_details set note=? where name = 'after_payment'", array($message));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_POST['update_birthday'])){
        $message = $_POST['birthday'];
        $trans_pin = $_POST['fakepasswordremembered'];

        $query = selectPDO("select * from users where id = ?", array($admin_id));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $pin = $row['user_pin'];
        }

        if(!password_verify($trans_pin, $pin)){
            $error = "Transaction PIN is incorrect!";
        }else{
            
            // privilege
            otherPDO("update page_details set note=? where name = 'birthday'", array($message));

            $success = "Changes have been updated successfully!";
                
        }
    }

    if(isset($_GET['del'])){
        otherPDO("delete from news_tags where id = ?", array($_GET['del']));
        $success = "Tag entry has been deleted!";
    }

    $query = selectPDO("select * from page_details", array());
    while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
        if($row['name']=="earnings"){
            $earnings = $row['note'];
        }

        if($row['name']=="after_register"){
            $registration = $row['note'];
        }

        if($row['name']=="after_payment"){
            $payment = $row['note'];
        }

        if($row['name']=="birthday"){
            $birthday = $row['note'];
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
        <title>Notifications & Page Info | Blackloop Club</title>
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
                            <h1>Notifications & Page Info</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Notifications & Page Info</li>
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
                        <div class="col-xs-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Exponential Compensation Description for Dashboard Earnings Page</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <textarea required="" id="summernote" name="earnings"><?php echo $earnings; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" name="trans_pin" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_exponential" onclick="return confirm('Confirm changes?');" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Email to be sent after registration</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       <p>To include user's firstname or lastname add FNAME and / or LNAME</p>
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <textarea required="" id="summernote2" name="registration"><?php echo $registration; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" name="trans_pin" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_registration" onclick="return confirm('Confirm changes?');" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Email to be sent after payment</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       <p>To include user's firstname or lastname add FNAME and / or LNAME</p>
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <textarea required="" id="summernote3" name="payment"><?php echo $payment; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-7 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" required="" name="trans_pin" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_payment" onclick="return confirm('Confirm changes?');" class="btn btn-labeled btn-success m-b-5 ">
                                            <span class="btn-label"><i class="glyphicon glyphicon-ok"></i></span>Submit
                                        </button>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Add News Update Tag</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       
                                        
                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Tag Name</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" required="" name="name" type="text" placeholder="Enter tag name" id="amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Choose Color</label>
                                            <div class="col-sm-7">
                                                <select id="color" class="form-control" name="color">
                                                    <optgroup>
                                                        <option disabled selected></option>
                                                        <option value="default">Default (Grey)</option>
                                                        <option value="primary">Primary (Blue)</option>
                                                        <option value="success">Success (Green)</option>
                                                        <option value="info">Info (Light-blue)</option>
                                                        <option value="warning">Warning (Yellow)</option>
                                                        <option value="danger">Danger (Red)</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" autocomplete="new-password" required="" name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="add_tag" onclick="return checkColor();" class="btn btn-labeled btn-success m-b-5 ">
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
                                        <h4>Set Default Birthday Message</h4>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    <div class="panel-body">
                                       <p>To include user's firstname or lastname add FNAME and / or LNAME</p>
                                        
                                        <div class="form-group row">
                                            <div class="col-xs-12">
                                                <textarea class="form-control" name="birthday" placeholder="Type birthday message here"><?php echo $birthday; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="example-number-input" class="col-sm-5 col-form-label">Transaction PIN</label>
                                            <div class="col-sm-7">
                                                <input class="form-control" autocomplete="new-password" required="" name="fakepasswordremembered" type="password" placeholder="Enter transaction PIN" id="trans_pin">
                                            </div>
                                        </div>

                                        <button  type="submit" name="update_birthday" onclick="return confirm('Confirm changes?')" class="btn btn-labeled btn-success m-b-5 ">
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
                                        <h4>Manage News Update Tags</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Tag Name</th>
                                                    <th>Color</th>
                                                    <th>Manage</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo allNewsTags(); ?>
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
