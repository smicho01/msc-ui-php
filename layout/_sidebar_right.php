<!-- SIDEBAR RIGHT -->
<div class="col-lg-3 sidebar-main">
    <!-- USER SIDEBAR -->
    <?php if(isUserLoggedIn()):?>
        <?php include("_user_sidebar.php"); ?>
    <?php endif; ?>
    <!-- //USER_SIDEBAR -->



    <ul class="list-group sidebar-list-group">
        <li class="list-group-item">Recent question number 1</li>
        <li class="list-group-item">How to train RNN</li>
        <li class="list-group-item">Help with B+ Trees indexes</li>
    </ul>

</div>
<!-- //SIDEBAR RIGHT -->