<?php

class Text2reach_SMS_Status extends Text2reach_SMS {
    protected $required_params = array(
        'id',
    );

    public $id = null;
    public $status = null;
    public $retries = null; // How many times Text2reach tried to deliver report via Text2reach_SMS_Bulk->report_url

    /**
     *
     */
    public function get() {
        $this->uri_init('sms/status')
            ->uri_param('msg_id', (int)$this->id)
        ;

        $this->execute();

        $this->status = $this->response;
    }

    /**
     *
     */
    public function create_from_report($report) {
        $this->id = isset($report['msg_id']) ? $report['msg_id'] : null;
        $this->status = isset($report['status']) ? $report['status'] : null;
        $this->retries = isset($report['retries']) ? $report['retries'] : null;
    }

    /**
     *
     */
    public function is_delivered() {
        return $this->status == self::STATUS_DELIVERED;
    }
}