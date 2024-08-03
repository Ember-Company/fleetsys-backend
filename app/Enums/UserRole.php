<?php

namespace App\Enums;

enum UserRole: int
{
    case MASTER = 0;
    case ADMIN = 1;
    case USER = 2;
    case DRIVER = 3;

    public function name()
    {
        return match ($this){
            UserRole::MASTER => __('MASTER'),
            UserRole::ADMIN => __('ADMIN'),
            UserRole::USER => __('USER'),
            UserRole::DRIVER => __('DRIVER'),
        };
    }
}
