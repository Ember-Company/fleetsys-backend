<?php

namespace App\Enums;

enum FuelType:int {

    case Gasoline=1;
    case Diesel=2;
    case Ethanol=3;
    case NaturalGas=4;

    public function name()
    {
        return match ($this) {
            FuelType::Gasoline => __('Gasoline'),
            FuelType::Diesel => __('Diesel'),
            FuelType::Ethanol => __('Ethanol'),
            FuelType::NaturalGas => __('Natural Gas'),
        };
    }
}