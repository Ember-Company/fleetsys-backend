<?php

namespace App\Enums;

enum MeterUnit: int
{
    case KILOMETER=0;
    case MILE=1;

    public function name()
    {
        return match($this){
            MeterUnit::KILOMETER => __('Kilometers'),
            MeterUnit::MILE => __('Miles')
        };
    }
}
