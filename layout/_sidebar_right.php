<!-- SIDEBAR RIGHT -->
<div class=" col-xl-3 col-lg-3  sidebar-main">

    <div class="col-12 d-grid gap-2 mb-3">
        <a href="/index.php?c=questions&v=add" class="btn btn-primary">Ask Question</a>
    </div>

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

    <h4>Recent questions</h4>
    <div class="list-group recent-questions-sidebar">
        <a href="#" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">How to set weight for RNN and LSTM ?</h5>
                <small>3 days ago</small>
            </div>
            <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consequuntur dignissimos expedita, laudantium magni placeat quisquam repudiandae sapiente? At, commodi.</p>
            <small>Machine Learning</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
            </div>
            <p class="mb-1">Some placeholder content in a paragraph.</p>
            <small class="text-muted">And some muted small print.</small>
        </a>
    </div>

</div>
<!-- //SIDEBAR RIGHT -->