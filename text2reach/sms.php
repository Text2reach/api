<?php

abstract class Text2reach_SMS extends Text2reach_API {
    const ERR_API_KEY_INVALID = -400;
    const ERR_PARAMETERS_MISSING = -500;
    const ERR_MESSAGE_TYPE_INVALID = 501; // Must be "txt" (default) or "bin"
    const ERR_DESTINATION_ADDRESS_BLOCKED = -503; // Reserved, unused
    const ERR_NOT_AVAILABLE_FOR_OPERATOR = -504; // Reserved, unused
    const ERR_DESTINATION_ADDRESS_INVALID = -508; // Number invalid or network operator does not support sending to this number
    const ERR_MESSAGE_ENCODING_INVALID = -509; // Reserved, unused
    const ERR_NONEXISTENT_NUMBER_OWNER_CHANGED = -511; // Mostly happens when invalid number used
    const ERR_MESSAGE_LENGTH_INVALID = -513;
    const ERR_SENDER_NAME_PERMISSION_DENIED = -514; // No access rights to use given From field
    const ERR_INSUFFICIENT_FUNDS = -515;
    const ERR_SYSTEM_ERROR = -555; // Something went terribly wrong

    const STATUS_DELIVERED = 'delivered';
    const STATUS_UNDELIVERED = 'undelivered';
    const STATUS_EXPIRED = 'expired'; // Was not delivered in Network operator's default or Text2reach_SMS_Bulk->expire time
    const STATUS_CANCELED = 'canceled';
    const STATUS_REJECTED = 'rejected'; // Usually happens when sending identical SMS to the same number in a short period of time
    const STATUS_PENDING = 'pending';
    const STATUS_UNKNOWN = 'unknown';

    public $id = null; // Unique SMS identifier in Text2reach system
}