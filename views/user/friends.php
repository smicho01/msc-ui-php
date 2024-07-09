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