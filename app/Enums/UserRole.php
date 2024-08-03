<?php

namespace App\Enums;

enum UserRole: int
{
    case ADMIN = 1;
    case USER = 2;
    case DRIVER = 3;

    public function name()
    {
        return match ($this){
            UserRole::ADMIN => __('ADMIN'),
            UserRole::USER => __('USER'),
            UserRole::DRIVER => __('DRIVER'),
        };
    }

}
