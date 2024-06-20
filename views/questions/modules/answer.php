<?php
$cadCss = '';
$isCardOwner = false;

if(isset($_SESSION['user'])){
    if($answer['userId'] == $_SESSION['user']['id']) {
        $cadCss = 'top-badge';
        $isCardOwner = true;
    }
}


?>

<div class="card answer <?php echo $cadCss; ?>">
    <?php if($isCardOwner): ?>
        <span class="answer-owner">Your answer</span>
    <?php endif; ?>

    <div class="card-header <?php echo $isCardOwner ?  'owner' : ''; ?>">
        <span class="entry"><span class="light-txt">Answered:</span> <?php echo format_date_from_java($answer['dateCreated']); ?></span>
        by: <span class="user-name"><?php echo $answer['userName']; ?></span>
    </div>
    <div class="card-body">
        <?php echo nl2br($answer['content']); ?>
    </div>
</div>
<div class="divider mb20"></div>


