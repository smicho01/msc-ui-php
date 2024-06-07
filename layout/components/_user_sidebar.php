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
        <div>
            <img src="public/img/academi-token.webp" width="40"  />
            <span class="token-qty"><?php echo $MAIN_USER->tokens; ?> tokens</span>
        </div>
    </div>
    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
       href="/index.php?c=user&v=questions">
        <div class="ms-2 me-auto">Your questions</div>
        <span class="badge bg-primary rounded-pill">
            <?php echo $_SESSION['user']['questions-size']; ?>
        </span>
    </a>

    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-start"
       href="/index.php?c=user&v=answers">
        <div class="ms-2 me-auto">Your answers</div>
        <span class="badge bg-primary rounded-pill">
            <?php echo $_SESSION['user']['answers-size']; ?>
        </span>
    </a>
</div>