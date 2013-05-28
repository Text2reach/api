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
    $sms->from = 'Text2reach API'; // Name that will show in phone as sender's name
    $sms->phone = '37100000000'; // Works best with an appropriate country code attached, e.g. 44 for United Kingdom
    $sms->message = 'Wrapper test message';
    $sms->report_url = T2R_REPORT_URL;
    $sms->send();
    echo 'SMS id: ', $sms->id, '<br>';
}
catch (Text2reach_Exception $e) {
    echo 'Exception: ', $e->getMessage(), '<br>';
    echo 'Response: ', $sms->response(), '<br>'; // View the full list of responses in text2reach/sms.php
}

sleep(5);

try {
    $status = new Text2reach_SMS_Status(T2R_API_KEY);
    $status->id = $sms->id;
    $status->get();
    echo 'SMS status: ', $status->status, '<br>'; // View the full list of statuses in text2reach/sms.php
}
catch (Text2reach_Exception $e) {
    echo 'Exception: ', $e->getMessage(), '<br>';
    echo 'Response: ', $status->response(), '<br>'; // View the full list of responses in text2reach/sms.php
}