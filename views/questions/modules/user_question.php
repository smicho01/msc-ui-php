<div class="question-user-options">
<!-- STATUS -->
    <span class="badge status-<?php echo  strtolower($question['status']); ?>">
        Status: <?php echo $question['status']; ?>
    </span>

</div>

<div class="question-details-wrapper">
    <div class="row heading">
        <div class="col-8">
            <h3><?php echo $question['title']; ?></h3>
        </div>
        <div class="col-4 d-flex flex-row-reverse bd-highlight">
            <a href="/index.php?c=questions&v=add" class="btn btn-primary">Ask Question</a>
        </div>
        <div class="col-12 question-summary-box">
            <span class="entry"><span class="light-txt">Created:</span> 2024-05-10</span>
            <span class="entry"><span class="light-txt">Modified:</span> 2024-05-10</span>
        </div>
    </div>
</div>