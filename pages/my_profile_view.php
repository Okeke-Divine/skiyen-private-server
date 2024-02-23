<?php
$rootDir = "../";
require '__inheritIncludes.php';
?>
<div class="page_header">
    <div>
        <span class="app_badge_1">My Profile</span> - <?php echo $ses_first_name . " " . $ses_last_name; ?> | <?php echo $ses_user_name; ?>
        <div class="mainTitle">
            Profile
            |
            <?php echo htmlspecialchars('SELECT * FROM privateDatabase.userDetails WHERE profile === myProfile'); ?>
        </div>
    </div>
</div>

<div class="page_body">
    <div class="myProfileDivCont">
        <h4>Profile Details</h4>
        <div class="dsjd98gBJIh">
            ----------------
        </div>
        <div class="dj9UNIO_"><span class="app_badge_1">Id No:</span> <?php echo $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'identificationNumber'); ?></div>

        <div class="dj9UNIO_"><span class="app_badge_1">Firstname:</span> <?php echo $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'firstname'); ?></div>

        <div class="dj9UNIO_"><span class="app_badge_1">Lastname:</span> <?php echo $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'lastname'); ?></div>

        <div class="dj9UNIO_"><span class="app_badge_1">Username:</span> <?php echo $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'username'); ?></div>

        <div class="dj9UNIO_"><span class="app_badge_1">Email:</span> <?php echo $site_db_fetch->fetch_user_colum('userId',$ses_user_id,'email'); ?></div>

        <div class="dj9UNIO_"><span class="app_badge_1">Password:</span> ******</div>
    </div>
</div>