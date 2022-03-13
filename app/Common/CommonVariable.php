<?php

namespace App\Common;

/**
 * This is used for common variable for all
 */

class Variable
{
    //PUBLIC
    public $REQUEST = 1; // Reject status
    public $APPROVE = 2; // Approve status
    public $WAITING = 3; // Waiting status
    public $REJECT = 4; // Reject status

    public $REQ_MESSAGE_DET = "Your Paymemt is Pending.We Will Reply Soon.";
    public $APP_MESSAGE_DET = "Your Payment Was Accepted By Admin.We Charged to Your Wallet ";
    public $WAIT_MESSAGE_DET = "Your Payment is Waiting List.";
    public $REJ_MESSAGE_DET = "Your Payment Was Reject By Admin.Contact Our Cell Center";


    public $REQ = "REQUEST";
    public $APP = "APPROVED";
    public $WAIT = "WAITING";
    public $REJ = "REJECT";

}
