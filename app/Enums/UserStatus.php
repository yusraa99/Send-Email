<?php

namespace App\Enums;

enum UserStatus : string {
    case Active = 'active';
    case Reject = 'reject';
    case Pending = 'pending';
    

}