<div class="row">
    <div class="col-12">
        <h3>Search results for term: <?php echo $searchTerm; ?></h3>
    </div>
    <div class="divider"></div>
</div>

<div id="search-results">
    <?php if ($foundUsersCount > 0): ?>
        <?php $displayUserResults = ($displayResults <= $foundUsersCount) ? $displayResults : $foundUsersCount; ?>
        <div class="row search-results-box">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Users (<?php echo $displayUserResults; ?> out of <?php echo $foundUsersCount; ?> )</h5>
                    </div>
                    <div class="card-body">

                        <?php for ($i = 0; $i < $displayUserResults; $i++): $user = $foundUsers[$i]; ?>
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
                    <?php if ($foundUsersCount > $displayResults) : ?>
                        <a href="index.php?c=search&v=all&entity=users&term=<?php echo $_SESSION['searchTerm']; ?>"
                           class="card-footer  show-more-results">
                            <div class="text-center">See all found users</div>
                        </a>
                    <?php else: ?>
                        <div class="card-footer  show-more-results">
                            <div class="text-center">Showing all <?php echo $foundUsersCount; ?> results found</div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
        <!-- /USERS -->
    <?php endif; ?>


    <?php if ($foundQuestionsCount > 0): ?>
        <?php $displayQuestionsResults = ($displayResults <= $foundQuestionsCount) ? $displayResults : $foundQuestionsCount; ?>
        <!-- QUESTIONS -->
        <div class="row search-results-box">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Questions (<?php echo $displayQuestionsResults; ?> out
                            of <?php echo $foundQuestionsCount; ?> )</h5>
                    </div>
                    <div class="card-body">
                        <?php for ($i = 0; $i < $displayQuestionsResults; $i++): $question = $foundQuestions[$i]; ?>
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
                    <?php if ($foundQuestionsCount > $displayResults) : ?>
                        <a href="index.php?c=search&v=all&entity=question&term=<?php echo $_SESSION['searchTerm']; ?>"
                           class="card-footer  show-more-results">
                            <div class="text-center">See all found questions</div>
                        </a>
                    <?php else: ?>
                        <div class="card-footer  show-more-results">
                            <div class="text-center">Showing all <?php echo $foundQuestionsCount; ?> results found</div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- /QUESTIONS -->
    <?php endif; ?>


</div>
