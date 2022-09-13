<?php
    require_once "../../functions_basic.php";

    if(isset($_COOKIE["blackloopclub"])){ // check if cookies is active
        $email_slug = $_COOKIE["blackloopclub"];
    } 
    
    if(isset($_SESSION['blackloop_slug'][0]) && isset($_SESSION['blackloop_slug'][2]) && isset($_SESSION['blackloop_slug'][3]) && isset($_SESSION['blackloop_slug'][4]) && isset($_SESSION['blackloop_slug'][5])){
        // sessions are still active and accurate
        $query = selectPDO("select * from users where email_slug = ? and fname = ? and lname = ? and profile_pic = ? and password = ? and user_status = '1'", array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][2], $_SESSION['blackloop_slug'][3], $_SESSION['blackloop_slug'][4], $_SESSION['blackloop_slug'][5]));
        // credentials don't match
        if($query->rowCount()==0){
            // unset user sessions
            unset($_SESSION['blackloop_slug']);
            // store requesting url
            $_SESSION['req_link'] = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $_SESSION['login_error'] = "Incorrect email or password!";
            header("Location: {$GLOBALS['path']}login");
            exit;
        }
        // else session is active and accurate
         // PROCEED TO CURRENT PAGE
    }elseif(isset($email_slug)){ // cookies memory
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
    
    
    