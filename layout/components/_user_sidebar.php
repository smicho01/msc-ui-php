<div class="list-group sidebar-list-group">
    <div class="list-group-item user-box">
        <div>
            <div class="user-icon-wrapper">
                <i class="fa-regular fa-circle-user fa-6x large-user-icon"></i>
                <h5><?php echo $MAIN_USER->visibleUsername; ?></h5>
                <p class="font-small" ><?php echo $MAIN_USER->college; ?></p>
                <p>
                    This is the name other users see you under. Your true identity is hidden.
                </p>
                <p>
                    <a href="/index.php?c=user&v=account">Your Account</a>
                </p>
            </div>

        </div>
    </div>
    <div class="list-group-item">
        <div class="row">
            <div class="col-2">
                <img src="public/img/academi-token.webp" width="40"  />
            </div>
            <div class="col-8">
                <span class="token-qty">
                <span class="span-tokens-count"><?php echo $MAIN_USER->tokens; ?></span> tokens</span>
            </div>
            <div class="col-2 position-relative">
                <span class="reload-tokens">
                        <i class="fa-solid fa-arrows-rotate" title="Reload"></i>
                </span>
            </div>

        </div>
    </div>
    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
       href="/index.php?c=user&v=questions">
        <div class="ms-2 me-auto">Your questions</div>
        <span class="badge bg-primary rounded-pill span-questions-size">
            <?php echo $_SESSION['user']['questions-size']; ?>
        </span>
    </a>

    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
       href="/index.php?c=user&v=answers">
        <div class="ms-2 me-auto">Your answers</div>
        <span class="badge bg-primary rounded-pill span-answers-size" >
            <?php echo $_SESSION['user']['answers-size']; ?>
        </span>
    </a>
</div>