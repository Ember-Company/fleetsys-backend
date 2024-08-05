<?php

namespace App\Enums;

enum FuelVolumeUnit: int
{
    case LITERS=0;
    case US_GALLONS=1;
    case UK_GALLONS=2;

    public function name()
    {
        return match ($this) {
            FuelVolumeUnit::LITERS => __('Liters'),
            FuelVolumeUnit::US_GALLONS => __('US Gallons'),
            FuelVolumeUnit::UK_GALLONS => __('UK Gallons')
        };
    }
}
