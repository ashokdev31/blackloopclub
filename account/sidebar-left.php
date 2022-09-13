<?php 

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
        $user_code = $row['user_code'];
        $last_online = $row['last_online'];
        $next_online = $row['next_online'];
        $news_read = $row['news_read'];
    }

    $news_badge = newsBadge($last_online, $next_online, $news_read);
    $closed_badge = closedTicketBadge($user_id);
    $open_badge = openTicketBadge($user_id);
    
?>
<div class="sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-heading text-center hidden-lg"> <span>Hello <?php echo $_SESSION['blackloop_slug'][2]; ?>!</span></li>
            <li class="nav-heading text-center hidden-xs hidden-sm hidden-md"> <span>-- &nbsp;&nbsp;Main Navigation&nbsp;&nbsp; --</span></li>
            <li class="active"><a href="index" class="material-rippl"><i class="fa fa-home"></i> Dashboard</a></li>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-user"></i> My Profile<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="profile">Manage Profile</a></li>
                    <li><a href="#">Upgrade Membership</a></li>
                </ul>
            </li>
            <?php if(restrictUserTotal()){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fab fa-bitcoin"></i> Earnings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="earnings">View Earnings</a></li>
                </ul>
            </li>
            <?php } if(restrictUserPartial()){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-exchange-alt"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="wallet-bank">Wallet to Bank</a></li>
                    <?php if(restrictUserTotal()){ ?>
                    <li><a href="wallet-voucher">Wallet to Voucher</a></li>
                    <li><a href="wallet-user">Wallet to User</a></li>
                    <li><a href="bank-voucher">Bank to Voucher</a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-envelope-open"></i> Tickets<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="active-tickets">Active Tickets <?php echo $open_badge; ?></a></li>
                    <li><a href="closed-tickets">Closed Tickets <?php echo $closed_badge; ?></a></li>
                    <li><a href="new-ticket">Open New Ticket</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-film"></i> Media Center 
                    <?php echo $news_badge; ?><span class="fa arrow"></span></a>

                <ul class="nav nav-second-level">
                    <li><a href="videos">Videos</a></li>
                    <li><a href="downloads">Downloads</a></li>
                    <li><a href="notifications">Notifications</a></li>
                    <li><a href="news-updates">News Updates <?php echo $news_badge; ?></a></li>
                </ul>
            </li>
            
            <li class="nav-heading text-center"> <span>-- &nbsp;&nbsp;More Navigation&nbsp;&nbsp; --</span></li>
            <?php if(restrictUserTotal()){ ?>
            <li><a href="#" data-toggle="modal" data-target="#referralModal"><i class="fa fa-link"></i>Referral Link</a></li>
            <?php } ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-shopping-cart"></i> Shop<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo $GLOBALS['path']; ?>shop" target="_blank">Go to Shop</a></li>
                    <li><a href="#">Order History / Tracking</a></li>
                    <li><a href="#">Wishlist</a></li>
                    <li><a href="#">Cart</a></li>
                </ul>
            </li>
            <li><a href="<?php echo $GLOBALS['path']; ?>"><i class="fa fa-globe"></i>Blackloop Home</a></li>
            <li><a href="#" onclick="logout();"><i class="fa fa-sign-out-alt"></i>Logout</a></li>
        </ul>
        <hr/>
        
    </div>
</div>

<div class='modal fade' id='referralModal' tabindex='-1' role='dialog'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h1 class='modal-title'>Referral Link</h1>
                </div>
                <div class='modal-body'>
                    <div class='form-group'>
                        <label for='exampleSelect1'>Referral Code</label>
                        <input readonly="" type="text" value="<?php echo $user_code; ?>" class="form-control">
                    </div>
                    <div class='form-group'>
                        <label for='exampleSelect1'>Referral Link</label>
                        <input type="text" readonly="" id="refCode" value="https://www.blackloopclub.com/register?ref_code=<?php echo $user_code; ?>" class="form-control">
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                    <button type="button" onclick="copyRef();" class="btn btn-labeled btn-success m-b-5 toastr2">
                        <span class="btn-label"><i class="fa fa-copy"></i></span>Copy Link
                    </button>
                </div>
        </div>
    </div>
</div>