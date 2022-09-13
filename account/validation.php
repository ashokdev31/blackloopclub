<?php
    require_once "../functions_basic.php";

    if(isset($_COOKIE["blackloopclub"])){ // check if cookies is active
        $email_slug = $_COOKIE["blackloopclub"];
    } 

    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(isset($_POST['remember'])){$remember = $_POST['remember'];}else{$remember="0";}
        
        $query = selectPDO("select * from users where email = ? and password <> '' and (user_status =  '0' or user_status = '1' or user_status = '2' or user_status = '4' or user_status = '-1')", array($email));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            if($row['user_status']=="-1") {
                if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
                $_SESSION['login_error'] = "Your account has been blocked! Please contact us through your registered email at contact@blackloopclub.com";
                header("Location: {$GLOBALS['path']}login");
                exit;
            }
            $hash = $row['password'];
            $slug = $row['email_slug'];
            $roles = $row['roles'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $dp = $row['profile_pic'];
            $id = $row['id'];
            $last_online = $row['next_online'];
            $next_online = date("Y-m-d H:i:s");
        }

        if($query->rowCount()>0){
            if(!password_verify($password, $hash)) {
                if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
                $_SESSION['login_error'] = "Email or password is incorrect!";
                header("Location: {$GLOBALS['path']}login");
                exit;
            }else{ // correct login
                $user = array($slug, $roles, $fname, $lname, $dp, $hash);
                $_SESSION['blackloop_slug'] = $user;
                if($remember==1){
                    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
                    setcookie("blackloopclub", $slug, time() + (86400 * 30), "/", $domain, true, true);
                }else{
                    setcookie("blackloopclub", "", 1);
                }
                // update login time
                otherPDO("update users set last_online = ?, next_online = ? where id = ?", array($last_online, $next_online, $id));
                // if(isset($_SESSION['req_link'])){   // send user to requesting page
                //     $link = $_SESSION['req_link'];
                //     unset($_SESSION['req_link']);
                //     header("Location: {$link}");
                //     exit;
                // }else{
                    if($roles==NULL){
                        header("Location: {$GLOBALS['path']}account/index");
                        exit;
                    }else{
                        header("Location: {$GLOBALS['path']}account/myadmin/index");
                        exit;
                    }
                // }
            }
        }else{
            if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
            $_SESSION['login_error'] = "Email or password is incorrect!";
            header("Location: {$GLOBALS['path']}login");
            exit;
        }
    }elseif(isset($_POST['login_again'])){
        $email_slug = $_SESSION['blackloop_slug'][0];
        $password = $_POST['password'];
        
        $query = selectPDO("select * from users where email_slug = ? and password <> '' and (user_status =  '0' or user_status = '1' or user_status = '2' or user_status = '4' or user_status = '-1')", array($email_slug));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            if($row['user_status']=="-1") {
                if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
                $_SESSION['login_error'] = "Your account has been blocked! Please contact us through your registered email at contact@blackloopclub.com";
                header("Location: {$GLOBALS['path']}login");
                exit;
            }
            $hash = $row['password'];
            $slug = $row['email_slug'];
            $roles = $row['roles'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $dp = $row['profile_pic'];
            $id = $row['id'];
            $last_online = $row['next_online'];
            $next_online = date("Y-m-d H:i:s");
        }

        if($query->rowCount()>0){
            if(!password_verify($password, $hash)) {
                $_SESSION['login_error'] = "Incorrect password!";
                $_SESSION['lock_screen'] = "";
                // unset user sessions
                if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
                $user = array($slug, $roles, $fname, $lname, $dp);
                $_SESSION['blackloop_slug'] = $user;
                header("Location: {$GLOBALS['path']}lock-screen");
                exit;
            }else{  // correct login
                $user = array($slug, $roles, $fname, $lname, $dp, $hash);
                $_SESSION['blackloop_slug'] = $user;

                // update login time
                otherPDO("update users set last_online = ?, next_online = ? where id = ?", array($last_online, $next_online, $id));
                // if(isset($_SESSION['req_link'])){   // send user to requesting page
                //     $link = $_SESSION['req_link'];
                //     unset($_SESSION['req_link']);
                //     header("Location: {$link}");
                //     exit;
                // }else{
                    if($roles==NULL){
                        header("Location: {$GLOBALS['path']}account/index");
                        exit;
                    }else{
                        header("Location: {$GLOBALS['path']}account/myadmin/index");
                        exit;
                    }
                // }
            }
        }else{
            $_SESSION['login_error'] = "Email or password is incorrect!";
            $_SESSION['lock_screen'] = "";
            // unset user sessions
            // if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
            // $user = array($slug, $roles, $fname, $lname, $dp);
            // $_SESSION['blackloop_slug'] = $user;
            header("Location: {$GLOBALS['path']}lock-screen");
            exit;
        }
    }elseif(isset($_SESSION['blackloop_slug'][0]) && isset($_SESSION['blackloop_slug'][2]) && isset($_SESSION['blackloop_slug'][3]) && isset($_SESSION['blackloop_slug'][4]) && isset($_SESSION['blackloop_slug'][5])){
        // sessions are still active and accurate
        $query = selectPDO("select * from users where email_slug = ? and fname = ? and lname = ? and profile_pic = ? and password = ? and (user_status =  '0' or user_status = '1' or user_status = '2' or user_status = '4')", array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][2], $_SESSION['blackloop_slug'][3], $_SESSION['blackloop_slug'][4], $_SESSION['blackloop_slug'][5]));
        // credentials don't match
        if($query->rowCount()==0){
            // unset user sessions
            unset($_SESSION['blackloop_slug']);
            // store requesting url
            $_SESSION['req_link'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $_SESSION['login_error'] = "Please login again to continue!";
            header("Location: {$GLOBALS['path']}login");
            exit;
        }
        // else session is active and accurate
         // PROCEED TO CURRENT PAGE

    }elseif(isset($email_slug)){// cookies memory
        $query = selectPDO("select * from users where email_slug = ?", array($email_slug));
        while ($row=$query->fetch(PDO::FETCH_ASSOC)) {
            $roles = $row['roles'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $dp = $row['profile_pic'];
            // unset user sessions
            if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
        }
        // store requesting url
        $_SESSION['req_link'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if($query->rowCount()>0){
            $user = array($email_slug, $roles, $fname, $lname, $dp);
            $_SESSION['blackloop_slug'] = $user;
            $_SESSION['lock_screen'] = "";
            header("Location: {$GLOBALS['path']}lock-screen");
            exit;
        }else{
            $_SESSION['login_error'] = "Please login again to continue!";
            header("Location: {$GLOBALS['path']}login?x");
            exit;
        }
    }else{
        if(isset($_SESSION['blackloop_slug'])){unset($_SESSION['blackloop_slug']);}
        header("Location: {$GLOBALS['path']}login");
        exit;
    }
