<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $foundUser['visibleUsername']; ?></li>
            </ol>
        </nav>

    </div>
</div>
<div class="row">
    <div class="col-12 user-page-header">
        <h3><?php echo $foundUser['visibleUsername']; ?> <small>(user)</small></h3>
        <span>School: <b><?php echo $foundUser['college']; ?></b></span>
        <span>Rank: <b><?php echo $foundUser['rank']; ?></b></span>
        <span><span class="btn btn-success btn-sm" id="btn-add-friend">Add Friend</span></span>
        <div class="heading"></div>
    </div>


    <div class="col-12"><?php print_r($foundUser); ?></div>
</div>