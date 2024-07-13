<div class="row">

    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/?c=questions">Questions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>

        </div>
    </div>

    <div class="row heading">
        <div class="col-8">
            <h3>Add Question</h3>
        </div>
    </div>

    <!-- form -->
    <form id="form-ask-question" method="post" action="index.php?c=questions&v=process">
        <div id="form-errors"></div>
        <div class="mb-3">
            <label for="form-question-title" class="form-label">Title</label>
            <input type="text" class="form-control" id="form_question_title" name="form_question_title"
                   value="I need help with B+Tree indexing."/>
            <div id="form-question-title-help" class="form-text">
                Be specific as length matters. e.g. How to train Neural Network
            </div>
        </div>
        <div class="mb-3">
            <label for="form_question_problem" class="form-label">Specify your problem</label>
            <textarea class="form-control" id="form_question_problem" name="form_question_problem" rows="12">I need help with B+Tree indexing. I understand how to add new entries, but I don't exactly understand how removing works.
            </textarea>
        </div>
        <div class="mb-3">
            <label for="form_question_tags_input" class="form-label">Tags</label>
            <input type="text" class="form-control" id="form_question_tags_input"
                   value="java"/>
            <div id="form_question_tags_input-help" class="form-text">
                Specify tags. Use coma (`,`) or space (` `) to separate tags. e.g. java,spring boot,rest,api <br/>
                Click on tag to remove it from the list. For longer tags user hyphen (`-`) to separate words. e.g.
                machine-learning <br/>
                Min 2 max 5 tags allowed
            </div>
            <div id="tagsContainer"></div>
            <div id="limitMessage"></div>
        </div>

        <div class="mb-3">
            <label for="form_question_college" class="form-label">Your College</label>
            <input type="text" class="form-control" id="form_question_college" name="form_question_college"
                   value="<?php echo $_SESSION['user']['college']; ?>" disabled/>
            <div id="form-question-college-help" class="form-text">
                Select college module name or category. e.g. Information Security
            </div>
        </div>

        <div class="mb-3 autocomplete">
            <label for="form_question_module" class="form-label">Module (Select college module name or category. e.g.
                Information Security)</label>
            <input type="text" class="form-control" id="form_question_module" name="form_question_module"
                   autocomplete="off"/>
            <div id="selected_module"></div>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary" id="btn-submit-question">Submit question</button>
    </form>
    <!-- /form -->

</div>

<!-- Modal -->
<div class="modal fade" id="validateQuestionModal" tabindex="-1" aria-labelledby="validateQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validateQuestionModalLabel">Question Validation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Is your question Title and Body valid English and has no inappropriate words ?
                Validation gives negative result. Please refine your question title and/or body and try again.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>










