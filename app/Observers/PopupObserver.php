<?php

namespace App\Observers;

use App\Models\Popup;
use Illuminate\Support\Facades\Cache;

class PopupObserver
{
    public $afterCommit = true;

    public function saved(Popup $popup): void
    {
        Cache::forget('home_popup');
    }

    public function deleted(Popup $popup): void
    {
        Cache::forget('home_popup');
    }
}