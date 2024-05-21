<div class="row">

    <div class="col-xl-9 col-lg-9">

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
                <input type="text" class="form-control" id="form_question_tags_input" name="form_question_tags_input"
                       value="java"/>
                <div id="form_question_tags_input-help" class="form-text">
                    Specify tags. Use coma (`,`) or space (` `) to separate tags. e.g. java,spring boot,rest,api <br />
                    Click on tag to remove it from the list. For longer tags user hyphen (`-`) to separate words. e.g. machine-learning
                </div>
                <div id="tagsContainer"></div>
                <div id="limitMessage">Just 5 tags allowed</div>
            </div>
            <button type="submit" class="btn btn-primary" id="btn-submit-question">Submit question</button>
        </form>
        <!-- /form -->

    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










