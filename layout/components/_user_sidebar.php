<ul class="list-group sidebar-list-group">
    <li class="list-group-item user-box">
        <div>
            <div class="user-icon-wrapper">
                <i class="fa-regular fa-circle-user fa-6x large-user-icon"></i>
                <h5><?php echo $MAIN_USER->visibleUsername; ?></h5>
                <p>
                    This is the name other users see you under. Your true identity is hidden.
                </p>
                <p>
                    <a href="/index.php?c=user&v=account">Your Account</a>
                </p>
            </div>

        </div>
    </li>
    <li class="list-group-item">
        <div>
            <img src="public/img/academi-token.png" class="small-token" />
            <span class="token-qty"><?php echo $MAIN_USER->getTokens(); ?> tokens</span>
        </div>
    </li>
    <li class="list-group-item">A third item</li>
    <li class="list-group-item">A fourth item</li>
    <li class="list-group-item">And a fifth one</li>
</ul>