<?php

namespace App\Enums;

enum UserRole: string
{
    case MASTER = 'MASTER';
    case ADMIN = 'ADMIN';
    case USER = 'USER';
    case DRIVER = 'DRIVER';

    public function name()
    {
        return match ($this) {
            UserRole::MASTER => __('MASTER'),
            UserRole::ADMIN => __('ADMIN'),
            UserRole::USER => __('USER'),
            UserRole::DRIVER => __('DRIVER'),
        };
    }
}
