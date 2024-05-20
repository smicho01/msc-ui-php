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
            <input type="text" class="form-control" id="form_question_title" name="form_question_title" />
            <div id="form-question-title-help" class="form-text">
                Be specific as length matters. e.g. How to train Neural Network
            </div>
        </div>
        <div class="mb-3">
            <label for="form_question_problem" class="form-label">Specify your problem</label>
            <textarea class="form-control" id="form_question_problem" name="form_question_problem" rows="12" ></textarea>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- /form -->



    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










