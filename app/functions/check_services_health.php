<?php

$CORE_SERVICE = new Service('Core Service', CORE_SERVICE_URI);
$USER_SERVICE = new Service('User Service', USER_SERVICE_URI);
$ITEM_SERVICE = new Service('Item Service', ITEM_SERVICE_URI);

$SERVICES_LIST = [
    $CORE_SERVICE, $USER_SERVICE, //$ITEM_SERVICE
];

foreach ($SERVICES_LIST as $SERVICE) {
    if($SERVICE->getServiceStatusCode() != 200) {
        $CONTROLLER = 'error';
        $VIEW = 'service';
        $_SESSION['errorMessage'] = $SERVICE->getName() . ' not Found';
    }
}