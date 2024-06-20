<div class="row">

    <div class="col-xl-9 col-lg-9">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Questions</li>
                    </ol>
                </nav>

            </div>
        </div>

        <div class="row heading">
            <div class="col-8">
                <h3>Questions</h3>
            </div>
            <div class="col-4 d-flex flex-row-reverse bd-highlight">
                <a href="/index.php?c=questions&v=add" class="btn btn-primary float-right">Ask Question</a>
            </div>
        </div>





        <!-- questions -->
        <div class="row">
            <?php if(!empty($questions)): ?>

                <?php foreach($questions as $question): ?>
                    <!-- question box -->
                    <div class="col-12">
                        <div class="card question-card">
                            <div class="card-header">
                                <div class="one-half">
                                    <span class="user-name"><?php echo trim($question['userName']); ?></span>  in
                                    <span class="module-name"><?php echo trim($question['moduleName']); ?></span>
                                            - <span class="date"><?php echo  format_date_from_java($question['dateCreated']); ?></span>

                                </div>
                                <div class="one-half-last text-right">
                                    20 answers
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><a href="/index.php?c=questions&v=show&id=<?php echo $question['id']; ?>">
                                        <?php echo trimString($question['title'], 50); ?>
                                    </a></h5>
                                <p class="card-text">
                                    <?php echo trimString($question['content'], 100); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- /question-box -->
                <?php endforeach; ?>



            <?php else: ?>
                <p>No questions yet</p>
            <?php endif; ?>
        </div>
        <!-- /questions -->





    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










