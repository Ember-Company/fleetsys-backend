<?php

namespace App\Enums;

enum VehicleOwnership: int
{
    case OWNED=0;
    case LEASED=1;
    case RENTED=2;
    case CUSTOMER=3;

    public function name()
    {
        return match($this){
            VehicleOwnership::OWNED => __('Owned'),
            VehicleOwnership::LEASED => __('Leased'),
            VehicleOwnership::RENTED => __('RENTED'),
            VehicleOwnership::CUSTOMER => __('CUSTOMER')
        };
    }
}
