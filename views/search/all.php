<div class="row">
    <div class="col-12">
        <h3>All <?php echo $entity; ?> by search term: <?php echo $searchTerm; ?></h3>
    </div>
    <div class="divider"></div>
</div>

<div id="search-results">

    <?php if (isset($foundUsersCount) && $foundUsersCount > 0): ?>
        <div class="row search-results-box">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Users (<?php echo $foundUsersCount; ?> )</h5>
                    </div>
                    <div class="card-body">
                        <?php for ($i = 0; $i < $foundUsersCount; $i++): $user = $foundUsers[$i]; ?>
                            <!-- user -->
                            <div class="search-result search-result-user">
                                <div class="row">
                                    <div class="col-1">
                                        <i class="fa-regular fa-circle-user fa-3x"></i>
                                    </div>
                                    <div class="col-10">
                                        <span class="link"><a
                                                    href="index.php?c=user&v=show&un=<?php echo $user['visibleUsername']; ?>"><?php echo $user['visibleUsername']; ?></a></span>
                                        <span class="college"><?php echo $user['college']; ?></span> ;
                                        <span class="rank">Rank: <?php echo $user['rank']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /user -->
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /USERS -->
    <?php endif; ?>


    <?php if (isset($foundQuestionsCount) && $foundQuestionsCount > 0): ?>
        <!-- QUESTIONS -->
        <div class="row search-results-box">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Questions (<?php echo $foundQuestionsCount; ?> )</h5>
                    </div>
                    <div class="card-body">
                        <?php for ($i = 0; $i < $foundQuestionsCount; $i++): $question = $foundQuestions[$i]; ?>
                            <!-- question -->
                            <div class="search-result search-result-post">
                                <div class="row">
                                    <div class="col-12">
                                        <span class="link">
                                            <a href="index.php?c=questions&v=show&id=<?php echo $question['id']; ?>">
                                                <?php echo $question['title']; ?>
                                            </a>
                                        </span>
                                        <span class="user">By <?php echo $question['userName']; ?> on
                                    <span class="rank"><?php echo format_date_from_java($question['dateCreated']); ?></span>
                                </span>
                                        <span class="college"><?php echo $question['collegeName']; ?> -
                                    <span class="module"><?php echo $question['moduleName']; ?></span>
                                </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /question -->
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /QUESTIONS -->
    <?php endif; ?>

</div>
