<div class="row">
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

    <div class="row">
        <div class="col-8">
            <h3>
                Your Questions
            </h3>
        </div>
        <div class="col-4 d-flex flex-row-reverse bd-highlight">
            <a href="/index.php?c=questions&v=add" class="btn btn-primary">Ask Question</a>
        </div>
    </div>

    <div class="divider"></div>

    <!-- questions -->
    <div class="row">
        <?php if (!empty($questions)): ?>

            <?php foreach ($questions as $question): ?>
                <!-- question box -->
                <div class="col-12">
                    <div class="card question-card">
                        <div class="card-header">
                            <div class="one-half">
                                <?php echo trim($question['moduleName']); ?> - <span
                                        class="date"><?php echo format_date_from_java($question['dateCreated']); ?></span>
                                - <span class="badge  status-<?php echo strtolower($question['status']); ?>">
                                    <?php echo $question['status']; ?>
                                </span>
                            </div>
                            <div class="one-half-last text-right">
                                <?php echo $question['answersCount']; ?><?php echo $question['answersCount'] == 1 ? 'answer' : 'answers'; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a
                                        href="/index.php?c=questions&v=show&id=<?php echo $question['id']; ?>">
                                    <?php echo trimString($question['title'], 50) . "</code>"; ?>
                                </a></h5>
                            <p class="card-text">
                                <?php echo trimString($question['content'], 100) . "</code>"; ?>
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
