<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ExpiryRadials extends Widget
{
    protected static string $view = 'filament.widgets.expiry-radials';

    protected int | string | array $columnSpan = 'full';
}