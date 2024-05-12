<?php

//function service_user_healthcheck()
//{
//    return rest_call('GET',
//        USER_SERVICE_URI . "/healthcheck");
//}
//
//function service_user_status_code() {
//    $response = service_user_healthcheck();
//    if(isset($response['status_code'])) {
//        return $response['status_code'];
//    }
//    return 404;
//}

class Service {

    private $name;
    private $serviceUri;
    private $healthcheckEndpoint = '/healthcheck';

    function __construct($name, $serviceUri) {
        $this->name = $name;
        $this->serviceUri = $serviceUri;
    }

    private function serviceHealthcheck() {
        return rest_call('GET',
            $this->serviceUri . $this->healthcheckEndpoint);
    }

    public function getServiceStatusCode() {
        $response = $this->serviceHealthcheck();
        if(isset($response['status_code'])) {
            return $response['status_code'];
        }
        return 404;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getServiceUri()
    {
        return $this->serviceUri;
    }

    /**
     * @param mixed $serviceUri
     */
    public function setServiceUri($serviceUri)
    {
        $this->serviceUri = $serviceUri;
    }

    /**
     * @return string
     */
    public function getHealthcheckEndpoint()
    {
        return $this->healthcheckEndpoint;
    }

    /**
     * @param string $healthcheckEndpoint
     */
    public function setHealthcheckEndpoint($healthcheckEndpoint)
    {
        $this->healthcheckEndpoint = $healthcheckEndpoint;
    }
}


