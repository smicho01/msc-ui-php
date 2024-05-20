<div class="row">

    <div class="col-xl-9 col-lg-9">

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?c=user&v=account"">Your Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Your Answers</li>
                    </ol>
                </nav>

            </div>
        </div>

        <div class="row heading">
            <div class="col-8">
                <h3>Your Answers</h3>
            </div>
            <div class="col-4 d-flex flex-row-reverse bd-highlight">
                <a href="/index.php?c=questions&v=add" class="btn btn-primary float-right">Add Question</a>
            </div>
        </div>

        <!-- questions -->
        <div class="row">
            <?php if(!empty($userQuestions)): ?>


                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Applied Machine Learning
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Special title treatment</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>

            <?php else: ?>
                <p>No answers yet</p>
            <?php endif; ?>
        </div>
        <!-- /questions -->




    </div>
    <?php include("_sidebar_right.php"); ?>
</div>










