<?php

namespace inc\classes\API;

use inc\classes\CheckKatalog;
use WP_REST_Request;
use WP_REST_Response;

class CheckKatalog_API extends ELPTS_API
{
    public function __construct()
    {
        $this->endpoint_name = 'certificate';
        $this->method = 'POST';
        parent::__construct();
    }

    public function endpoint_callback(WP_REST_Request $request)
    {
        $certificateNumber = $request['certificateNumber'];
        if (!empty($certificateNumber)) {
            $class = new CheckKatalog();
            $result = $class->find($certificateNumber);
            sleep(1);
            return new WP_REST_Response($result);
        } else {
            return [
                'certificateNumber' => $certificateNumber,
                'status' => 'Номер сертификата не указан',
                'error' => true
            ];
        }
    }
}

new CheckKatalog_API(); 
