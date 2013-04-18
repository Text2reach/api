<?php

include('text2reach/api.php');
include('text2reach/exception.php');
include('text2reach/sms.php');
include('text2reach/sms/bulk.php');
include('text2reach/sms/status.php');

define('T2R_API_KEY', '<your key here>');
define('T2R_REPORT_URL', 'http://www.yoursite.com/report.php');

// Accept only from Text2reach IP
if (getenv('REMOTE_ADDR') != '213.175.74.35') {
    die;
}

try {
    $status = new Text2reach_SMS_Status(API_KEY);
    $status->create_from_report($_GET);

    $f = fopen('sms_reports.txt', 'a+');
    fwrite($f, "---".date('H:i:s d.m.Y')."---\n");
    fwrite($f, "SMS status: ".$status->status."\n");
    fwrite($f, "Retries: ".$status->retries."\n\n");
    fclose($f);

    echo 'OK';
}
catch (Text2reach_Exception $e) {

}