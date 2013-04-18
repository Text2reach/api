<?php

class Text2reach_SMS_Bulk extends Text2reach_SMS {
    protected $required_params = array(
        'from',
        'phone',
        'message',
    );

    public $from = null;
    public $phone = null;
    public $message = null;
    public $type = 'txt';
    public $unicode = true;
    public $timestamp = 0;
    public $report_url = false;
    public $expires = 0;

    /**
     *
     */
    public function send() {
        $this->uri_init('sms/bulk')
            ->uri_param('from', urlencode($this->from))
            ->uri_param('phone', str_replace(array(' ', '+'),'',$this->phone))
            ->uri_param('message', urlencode($this->message))
            ->uri_param('type', $this->type)
            ->uri_param('unicode', $this->unicode ? 'true' : 'false')
            ->uri_param('timestamp', (int)$this->timestamp)
            ->uri_param('report_url', $this->report_url ? $this->report_url : 'false')
            ->uri_param('expires', (int)$this->expires)
        ;

        $this->execute();

        if ($this->response < 0) {
            throw new Text2reach_Exception('Error sending SMS');
        }

        $this->id = $this->response;
    }
}