<?php

include('text2reach/api.php');
include('text2reach/exception.php');
include('text2reach/sms.php');
include('text2reach/sms/bulk.php');
include('text2reach/sms/status.php');

define('T2R_API_KEY', '<your key here>');
define('T2R_REPORT_URL', 'http://www.yoursite.com/report.php');

try {
    $sms = new Text2reach_SMS_Bulk(T2R_API_KEY);
    $sms->from = 'Text2reach API';
    $sms->phone = '37100000000';
    $sms->message = 'Wrapper test message';
    $sms->report_url = T2R_REPORT_URL;
    $sms->send();
    echo 'SMS id: ', $sms->id, '<br>';
}
catch (Text2reach_Exception $e) {
    echo 'Exception: ', $e->getMessage(), '<br>';
    echo 'Response: ', $sms->response(), '<br>';
}

sleep(5);

try {
    $status = new Text2reach_SMS_Status(T2R_API_KEY);
    $status->id = $sms->id;
    $status->get();
    echo 'SMS status: ', $status->status, '<br>';
}
catch (Text2reach_Exception $e) {
    echo 'Exception: ', $e->getMessage(), '<br>';
    echo 'Response: ', $status->response(), '<br>';
}