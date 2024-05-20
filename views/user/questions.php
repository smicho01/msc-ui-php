<div class="row">

    <div class="col-xl-9 col-lg-9">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?c=user&v=account"">Your Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your Questions</li>
                    </ol>
                </nav>

            </div>
        </div>

        <div class="row heading">
            <div class="col-8">
                <h3>
                    Your Questions
                </h3>
            </div>
            <div class="col-4 d-flex flex-row-reverse bd-highlight">
                <a href="/index.php?c=questions&v=add" class="btn btn-primary">Ask Question</a>
            </div>
        </div>

        <!-- questions -->
        <div class="row">
            <?php if(!empty($userQuestions)): ?>

                <!-- question box -->
                <div class="col-12">
                    <div class="card question-card">
                        <div class="card-header">
                            <div class="one-half">
                                Applied Machine Learning - <span class="date">2024-02-12</span>
                            </div>
                            <div class="one-half-last text-right">
                                20 answers
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="/index.php?c=questions&v=show&id=1">
                                    <?php echo substr("How to set weights for RNN", 0,50); ?>
                                </a></h5>
                            <p class="card-text">
                                <?php echo substr("How to set weights for RNN", 0,50); ?>
                                </p>
                        </div>
                    </div>
                </div>
               <!-- /question-box -->

               <!-- question box -->
                <div class="col-12">
                    <div class="card question-card">
                        <div class="card-header">
                            <div class="one-half">
                                ADM - <span class="date">2024-02-10</span>
                            </div>
                            <div class="one-half-last text-right">
                                8 answers
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="">Need help with B+ Tree Indexing</a></h5>
                            <p class="card-text">I need some help with removing values from B+ Tree index</p>
                        </div>
                    </div>
                </div>
                <!-- /question-box -->

            <?php else: ?>
                <p>No questions yet</p>
            <?php endif; ?>
        </div>
        <!-- /questions -->




    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










