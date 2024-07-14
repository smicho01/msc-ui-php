<div class="row">
    <div class="col-12">
        <h3>Service Error</h3>
        <?php

        if(isset($_SESSION['errorMessage'])) {
            echo $_SESSION['errorMessage'];
        }

        ?>
    </div>
</div>