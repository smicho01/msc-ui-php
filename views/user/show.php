<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $foundUser['visibleUsername']; ?></li>
            </ol>
        </nav>

    </div>
</div>
<div class="row">
    <div class="col-12 user-page-header">
        <h3 class="mb-4">User: <?php echo $foundUser['visibleUsername']; ?> <small>(user)</small></h3>
        <span>School: <b><?php echo $foundUser['college']; ?></b></span>
        <span>Rank: <b><?php echo $foundUser['rank']; ?></b></span>
        <?php if ($isFriendWithDisplayedUser): ?>
            <span><span class="btn btn-secondary btn-sm" data-ui="<?php echo $foundUser['id']; ?>"
                        id="btn-remove-friend">
                    <i class="fa-solid fa-user"></i>
                    Remove connection
                </span></span>
        <?php else: ?>
            <?php if ($friendRequestSentToUser): ?>
                <span class="btn btn-warning btn-sm" data-ui="<?php echo $foundUser['id']; ?>" id="btn-request-sent">
                    <i class="fa-solid fa-user-check"></i> Request sent
                </span>
            <?php else: ?>
                <span class="btn btn-primary btn-sm" data-ui="<?php echo $foundUser['id']; ?>" id="btn-add-friend">
                        <i class="fa-solid fa-user"></i> Connect
                </span>
            <?php endif; ?>
        <?php endif; ?>
        <div class="heading"></div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h5>Send message</h5>
        <div id="send-msg-response-wrapper"></div>
        <div class="input-group">
        <input type="text" class="form-control" id="message-body" placeholder="Type your message to <?php echo $_GET['un']; ?>">
        <button class="btn btn-primary" id="send-message" data-to="<?php echo $foundUser['id']; ?>">Send</button>
        </div>
    </div>
</div>

<!-- USER QUESTIONS -->
<div class="row mt-3">
    <div class="col-12">
        <h5>User Questions</h5>
    </div>
    <div class="col-12">
        <?php if(count($userQuestions) > 0) : ?>
            <?php foreach ($userQuestions as $question): ?>
                <!-- question box -->
                <div class="col-12">
                    <div class="card question-card">
                        <div class="card-header">
                            <div class="one-half">
                                <?php echo trim($question['moduleName']); ?> - <span
                                        class="date"><?php echo format_date_from_java($question['dateCreated']); ?></span>
                                - <span class="badge  status-<?php echo strtolower($question['status']); ?>">
                                    <?php echo $question['status']; ?>
                                </span>
                            </div>
                            <div class="one-half-last text-right">
                                <?php echo $question['answersCount']; ?><?php echo $question['answersCount'] == 1 ? ' answer' : ' answers'; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="/index.php?c=questions&v=show&id=<?php echo $question['id']; ?>">
                                    <?php echo trimString($question['title'], 50) . "</code>"; ?>
                                </a></h5>
                            <p class="card-text">
                                <?php echo trimString($question['content'], 100) . "</code>"; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /question-box -->
            <?php endforeach; ?>
        <?php else: ?>
        <p>The user does not have any questions yet</p>
        <?php endif; ?>
    </div>
</div>
<!-- /end USER QUESTIONS -->