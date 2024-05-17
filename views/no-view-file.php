<?php
insertDbLogData('ERROR', $CONTROLLER.":".$VIEW, 'view file not exists',
    'view file '.$VIEW. " for controller " . $CONTROLLER . " not found");

?>
<div class="row">
    <h1>404 Missing view file</h1>
    <p>
        The view file you requested doesn't exist.
    </p>
</div>