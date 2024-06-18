<div class="row">

    <div class="col-xl-9 col-lg-9">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?c=questions"">Questions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo substr($question['title'], 0,50); ?>
                        </li>
                    </ol>
                </nav>

            </div>
        </div>

        <?php if($isLoggedInUserQuestion): ?>
            <?php include_once ('modules/user_question.php'); ?>
        <?php else: ?>
            <?php include_once ('modules/non_user_question.php'); ?>
        <?php endif; ?>

        <?php include_once ('modules/tags.php'); ?>

        <div class="question-content">
            <?php echo nl2br($question['content']); ?>
        </div>


        <span class="divider"></span>
        <?php if($question['status'] == 'ACTIVE'): ?>
            <?php if(isUserLoggedIn()): ?>
                <a href="#" class="btn btn-primary" id="add-answer-button">Add answer</a>
            <span id="add-answer-status"></span>
            <span class="divider"></span>

            <div class="answer-form-wrapper" id="answer-form-wrapper">
                <form id="answer-form">
                    <div class="mb-3">
                        <label for="form_answer_field" class="form-label">Your answer</label>
                        <textarea class="form-control" id="form_answer_field"
                                  name="form_answer_field" rows="12"></textarea>
                        <input type="hidden" name="question_id" id="question_id" value="" />
                        <input type="hidden" name="user_id" id="user_id" value="" />
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit-question">Submit answer</button>
                </form>
            </div>
            <?php else:  ?>
            <a href="index.php?c=login" class="btn btn-primary">Login to add answer</a>
            <?php endif; ?>
        <?php else: ?>
            <p><b>Answers disabled.</b> Question must be in 'ACTIVE' status to add answers</p>
        <?php endif; ?>

    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










