<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/index.php?c=user&v=account">Your account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Connections & Friends</li>
            </ol>
        </nav>

    </div>
</div>
<div class="row">
    <div class="col-12">
        <h3 class="heading">Your Connections & Friends <small>(<?php echo count($friends); ?>)</small></h3>
    </div>
</div>


<!-- TABS -->
<ul class="nav nav-pills mb-1" id="friends-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link position-relative active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Friends</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link position-relative" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
            Requests sent
            <?php if(count($friendRequestsSent) > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo count($friendRequestsSent); ?>
            <span class="visually-hidden">unread messages</span>
           <?php endif; ?>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link position-relative" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
            Requests received
            <?php if(count($friendRequestsReceived) > 0): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <?php echo count($friendRequestsReceived); ?>
            <span class="visually-hidden">unread messages</span>
           <?php endif; ?>
  </span>
        </button>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <!--  FRIENDS -->
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="divider"></div>
        <?php foreach ($friends as $friend): ?>
            <div class="row friend-row">
                <div class="col-12 friend-col">
                    <div class="row">
                        <div class="col-1">
                            <div class="friend-icon-wrapper">
                                <i class="fa-regular fa-user friend-icon"></i>
                            </div>
                        </div>
                        <div class="col-3">
                            <a class="friend-link" href="index.php?c=user&v=show&un=<?php echo $friend['visibleUsername']; ?>">
                                <h5><?php echo $friend['visibleUsername']; ?></h5>
                            </a>
                        </div>
                        <div class="col-3">
                            Rank: <?php echo $friend['rank']; ?>
                        </div>
                        <div class="col-3">
                            <?php echo $friend['college']; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--  /FRIENDS -->

    <!--  REQUESTS SENT -->
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="divider"></div>
        <?php foreach ($friendRequestsSent as $friend): ?>
            <div class="row friend-row">
                <div class="col-12 friend-col">
                    <div class="row">
                        <div class="col-1">
                            <div class="friend-icon-wrapper">
                                <i class="fa-regular fa-user friend-icon"></i>
                            </div>
                        </div>
                        <div class="col-3">
                            <a class="friend-link" href="index.php?c=user&v=show&un=<?php echo $friend['visibleUsername']; ?>">
                                <h5><?php echo $friend['visibleUsername']; ?></h5>
                            </a>
                        </div>
                        <div class="col-3">
                            Rank: <?php echo $friend['rank']; ?>
                        </div>
                        <div class="col-3">
                            <?php echo $friend['college']; ?>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-danger btn-sm btn-cancel-friend-request" data-id="<?php echo $friend['id']; ?>">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--  /REQUESTS SENT -->

    <!--  REQUESTS RECEIVED -->

    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="divider"></div>
        <?php foreach ($friendRequestsReceived as $friend): ?>
            <div class="row friend-row">
                <div class="col-12 friend-col">
                    <div class="row">
                        <div class="col-1">
                            <div class="friend-icon-wrapper">
                                <i class="fa-regular fa-user friend-icon"></i>
                            </div>
                        </div>
                        <div class="col-3">
                            <a class="friend-link" href="index.php?c=user&v=show&un=<?php echo $friend['visibleUsername']; ?>">
                                <h5><?php echo $friend['visibleUsername']; ?></h5>
                            </a>
                        </div>
                        <div class="col-3">
                            Rank: <?php echo $friend['rank']; ?>
                        </div>
                        <div class="col-3">
                            <?php echo $friend['college']; ?>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-primary btn-sm btn-accept-friend-request" data-id="<?php echo $friend['id']; ?>">Accept</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!--  /REQUESTS RECEIVED -->
</div>
<!-- /TABS -->

