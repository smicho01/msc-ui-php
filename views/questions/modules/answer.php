<?php
$cadCss = '';
$isCardOwner = false;

if (isset($_SESSION['user'])) {
    if ($answer['userId'] == $_SESSION['user']['id']) {
        $cadCss = 'top-badge';
        $isCardOwner = true;
    }
}

?>

<div class="card answer <?php echo $cadCss; ?>">
    <?php if ($isCardOwner): ?>
        <span class="answer-owner">Your answer</span>
    <?php endif; ?>

    <div class="card-header <?php echo $isCardOwner ? 'owner' : ''; ?>">
        <span class="entry"><span
                    class="light-txt">Answered:</span> <?php echo format_date_from_java($answer['dateCreated']); ?></span>
        by: <span class="user-name"><?php echo $answer['userName']; ?></span>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <?php echo nl2br($answer['content']); ?>
            </div>
        </div>
        <div class="divider"></div>
        <div class="row">
            <div class="col">
                <div class="row answer-like-bar">
                    <div class="col-1"><span class="answer-like"><i
                                    class="ikonka pointer hoverable-green fa-solid fa-thumbs-up"></i></span></div>
                    <div class="col-1"><span class="answer-like-count"><span data-bs-toggle="tooltip"
                                                                             data-bs-placement="top"
                                                                             title="Votes from users">20</span></i></span>
                    </div>
                    <div class="col-1"><span class="answer-unlike"><i
                                    class="ikonka pointer   hoverable-red fa-solid fa-thumbs-down"></i></span></div>
                    <?php if ($answer['best'] == 1): ?>
                        <div class="col-1"><span class="answer-winner"><i
                                        class="ikonka pointer ikonka-winner fa-solid fa-circle-check"></i></span></span>
                        </div>
                    <?php endif; ?>
                    <?php if (!$hasBestAnswerSelected && isUserLoggedIn() &&
                                    QuestionService::isQuestionAuthorLoggedInUser($question) &&
                                    !AnswerService::isAnswerLoggedInUserAnswer($answer)): ?>
                        <div class="col-2"><span class="answer-like-count"><i
                                        class="ikonka ikonka-select-best pointer hoverable-green fa-solid fa-check-double"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="top"
                                        title="Select as best answer and give tokens to author !"></i></span></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="divider mb20"></div>


