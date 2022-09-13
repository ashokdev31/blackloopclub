<?php 
    require_once "../../functions_basic.php";

    echo password_hash("edidiong@blackloopclub.com", PASSWORD_BCRYPT)."<br/>";

    echo password_hash("Tedify1one", PASSWORD_BCRYPT)."<br/>";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Testing | Blackloop Club</title>
        
    </head>
    <body>
        <table class="table table-bordered table-striped table-hover" id="earnings_table">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Plan</th>
                    <th>Level</th>
                    <th>Referrals</th>
                    <th>Date Activated</th>
                </tr>
            </thead>
            <tbody>
                <?php echo totalReferrals(); ?>
            </tbody>
        </table>
    </body>
</html>
