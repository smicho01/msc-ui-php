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

    <?php if(isset($_SESSION['latestQuestions']['questions']) && count($_SESSION['latestQuestions']['questions'])>0) : ?>
    <h4>Recent questions</h4>
    <div class="list-group recent-questions-sidebar">
        <?php foreach ($_SESSION['latestQuestions']['questions'] as $question): ?>
        <a href="index.php?c=questions&v=show&id=<?php echo $question['id']; ?>" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $question['title'] ?></h5>
            </div>
            <small><?php echo  trimString($question['collegeName'], 30); ?></small> |
            <small><?php echo  trimString($question['moduleName'], 30); ?></small>
        </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
<!-- //SIDEBAR RIGHT -->