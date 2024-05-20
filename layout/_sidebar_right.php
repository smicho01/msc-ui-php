<!-- SIDEBAR RIGHT -->
<div class=" col-xl-3 col-lg-3  sidebar-main">
    <!-- USER SIDEBAR -->
    <?php if(isUserLoggedIn()):?>
        <?php include("_user_sidebar.php"); ?>
    <?php endif; ?>
    <!-- //USER_SIDEBAR -->

    <ul class="list-group sidebar-list-group">
        <a class="list-group-item list-group-item-action" href="/index.php?c=questions&v=show&id=1">
            How to train RNN
        </a>
        <li class="list-group-item">How to train RNN</li>
        <li class="list-group-item">Help with B+ Trees indexes</li>
    </ul>

</div>
<!-- //SIDEBAR RIGHT -->