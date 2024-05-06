<div class="row">
    <div class="col-9">
        <h3>Home</h3>


        <?php print_r($_SESSION); ?>

    </div>
    <!-- SIDEBAR -->
    <div class="col-3 sidebar-main">
        <!-- USER SIDEBAR -->
        <?php if(isUserLoggedIn()):?>
        <div class="sidebar-box user-sidebar">
            <h4>About You</h4>
            <h5><?php echo $MAIN_USER->visibleUsername; ?></h5>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi at, beatae commodi debitis dolor dolore ducimus, eos iure, libero nisi numquam obcaecati pariatur quas qui rerum ut vel vero voluptatum.
            </p>
        </div>
        <?php endif; ?>
        <!-- //USER_SIDEBAR -->
    </div>
    <!-- //SIDEBAR -->
</div>
