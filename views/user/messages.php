<div class="row">

    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?c=user&v=account"">Your Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Messages</li>
                </ol>
            </nav>

        </div>
    </div>

    <div class="row ">
        <div class="col-8">
            <h3>Your Messages</h3>
            <div class="col-12 question-summary-box">
                <span class="entry"><span class="light-txt">Total:</span> <?php echo count($messages); ?></span>
                <span class="entry"><span class="light-txt">Unread:</span> <?php echo count($messages); ?></span>
            </div>
        </div>
    </div>

    <div class="divider"></div>

    <!-- messages -->
    <div class="row">
        <div class="col-12">

            <div class="container p-0">

                <h1 class="h3 mb-3">Messages</h1>

                <?php if ($messages != null && count($messages) > 0): ?>
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-12 col-lg-5 col-xl-3 border-right">

                                <?php foreach ($messages as $message): ?>
                                    <?php
                                    $unreadMessagesWithUserCount = 0;
                                    foreach ($message['messages'] as $currMessage) {
                                        if ($currMessage['read'] == false && $currMessage['fromId'] != $_SESSION['user']['id']) {
                                            $unreadMessagesWithUserCount++;
                                        }
                                    }
                                    ?>
                                    <a href="index.php?c=user&v=messages&with=<?php echo $message['user']['id'] ?>"
                                       class="list-group-item list-group-item-action border-0">
                                        <?php if ($unreadMessagesWithUserCount > 0): ?>
                                            <div class="badge bg-success float-right"><?php echo $unreadMessagesWithUserCount; ?></div>
                                        <?php endif; ?>
                                        <div class="d-flex align-items-start">
                                            <img src="/public/img/avatars/<?php echo $message['user']['imageid']; ?>.jpg"
                                                 class="rounded-circle mr-1" alt="Vanessa Tucker" width="40"
                                                 height="40">
                                            <div class="flex-grow-1 ml-3">
                                                <?php echo $message['user']['visibleUsername']; ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                                <hr class="d-block d-lg-none mt-1 mb-0">
                            </div>
                            <div class="col-12 col-lg-7 col-xl-9">

                                <div class="position-relative">
                                    <div class="chat-messages p-4">
                                        <?php foreach ($selectedMessage['messages'] as $message):
                                            $currentMessageUserImageId = $message['fromId'] == $_SESSION['user']['id'] ? $_SESSION['user']['imageid'] : $selectedMessage['user']['imageid'];
                                            $messageOwnerVisibleUsername = $message['fromId'] == $_SESSION['user']['id'] ? 'You' : $selectedMessage['user']['visibleUsername'];
                                            ?>
                                            <div class="chat-message-right pb-4">
                                                <div>
                                                    <img src="/public/img/avatars/<?php echo $currentMessageUserImageId; ?>.jpg"
                                                         class="rounded-circle mr-1" alt="Chris Wood" width="40"
                                                         height="40">
                                                    <div class="text-muted small text-nowrap mt-2">
                                                        <?php echo format_date_from_java($message['dateCreated'], "Y-m-d H:i"); ?>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                    <div class="font-weight-bold mb-1">

                                                        <?php

                                                        if($messageOwnerVisibleUsername != 'You') {
                                                           echo $userLink = '<a href="index.php?c=user&v=show&un='.$messageOwnerVisibleUsername.'">' . $messageOwnerVisibleUsername . '</a>';
                                                        } else {
                                                            echo $messageOwnerVisibleUsername;
                                                        }

                                                        ?>
                                                    </div>
                                                    <?php echo $message['content']; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>

                                <div class="flex-grow-0 py-3 px-4 border-top">
                                    <div class="input-group" id="">
                                        <input type="text" class="form-control" id="message-body"
                                               placeholder="Type your message to <?php echo $selectedMessage['user']['visibleUsername']; ?>">
                                        <button class="btn btn-primary" id="send-message"
                                                data-to="<?php echo $selectedMessage['user']['id']; ?>">Send
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <p>You don't have messages yet.</p>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- /questions -->


</div>