<?php

namespace App\Traits;
use App\Observers\ModelObserver;
trait CreatedUpdatedID
{
    public static function bootCreatedUpdatedID()
    {
        static::observe(new ModelObserver);
    }
}
