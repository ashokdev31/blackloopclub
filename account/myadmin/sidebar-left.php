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
                </ul>
            </li>
            <?php if(validateSideAdmin(1)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fab fa-bitcoin"></i> Earnings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="all-earnings">View Earnings</a></li>
                    <li><a href="all-payouts">View Payouts</a></li>
                    <li><a href="withdrawals">Manage Withdrawals</a></li>
                    <li><a href="direct-pay">Direct Pay</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(2)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-users"></i> Manage Users<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="users">All Users</a></li>
                    <li><a href="active-users">Active Users</a></li>
                    <li><a href="pending-users">Pending Users</a></li>
                    <li><a href="declined-users">Declined Users</a></li>
                    <li><a href="blocked-users">Blocked Users</a></li>
                    <li><a href="restricted-users">Restricted Users</a></li>
                    <li><a href="deactivated-users">Deactivated Users</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(1)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-users"></i> Manage Admins<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="manage-admins">All Admins</a></li>
                    <li><a href="add-admin">Create New Admin</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(3)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-exchange-alt"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="wallet-bank">Wallet to Bank</a></li>
                    <li><a href="bank-voucher">Bank to Voucher</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(4)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-envelope-open"></i> Tickets<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="active-tickets">Active Tickets</a></li>
                    <li><a href="closed-tickets">Closed Tickets</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(5)){ ?>
            <li>
                <a href="#" class="material-ripple"><i class="fa fa-film"></i> Media Center<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="manage-videos">Videos</a></li>
                    <li><a href="manage-downloads">Downloads</a></li>
                    <li><a href="manage-updates">News Updates</a></li>
                    <li><a href="birthdays">Birthdays</a></li>
                    <li><a href="subscribers">Newsletter Subscribers</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(2)){ ?>
            <li><a href="referrals"><i class="fa fa-link"></i>Referrals</a></li>
            <?php } if(validateSideAdmin(1)){ ?>
            <li><a href="#" class="material-ripple"><i class="fa fa-cog"></i> Settings<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="fees-bank-details">Fees & Bank Details</a></li>
                    <li><a href="payouts-value-chart">Payouts & Value Chart</a></li>
                    <li><a href="page-info-notifications">Notifications & Page Info</a></li>
                </ul>
            </li>
            <?php } ?>
            <li class="nav-heading text-center"> <span>-- &nbsp;&nbsp;More Navigation&nbsp;&nbsp; --</span></li>
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