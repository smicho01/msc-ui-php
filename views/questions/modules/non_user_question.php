<div class="question-details-wrapper">
    <div class="row heading">
        <div class="col-9">
            <h3 id="question-title"><?php echo $question['title']; ?></h3>
        </div>
        <div class="col-3 bd-highlight text-right">
            <a href="/index.php?c=questions&v=add" class="btn btn-primary">Ask Question</a>
        </div>
        <div class="col-12 question-summary-box">
            <span class="entry"><span class="light-txt">Created:</span><?php echo format_date_from_java($question['dateCreated']); ?></span>
            <span class="entry"><span class="light-txt">Modified:</span> <?php echo  format_date_from_java($question['dateModified']); ?></span>
            <span class="entry"><span class="light-txt">Best answer selected:</span> <?php echo  $hasBestAnswerSelected  ? '<i class="ikonka ikonka-winner fa-solid fa-circle-check"></i>'
                    : '<i class="fa-solid fa-circle-xmark"></i>'; ?></span>
        </div>
    </div>
</div>