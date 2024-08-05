<?php

namespace App\Enums;

enum MeasurementSystem: int
{
    case METRIC=0;
    case IMPERIAL=1;

    public function name()
    {
        return match($this){
            MeasurementSystem::METRIC => __('Metric System'),
            MeasurementSystem::IMPERIAL => __('Imperial System')
        };
    }
}
