<?php

namespace App\Enums;

enum StatusColors: string
{
    case SUCCESS = 'success';
    case DEFAULT = 'default';
    case ERROR = 'error';
    case INFO = 'info';
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case WARNING = 'warning';
}
