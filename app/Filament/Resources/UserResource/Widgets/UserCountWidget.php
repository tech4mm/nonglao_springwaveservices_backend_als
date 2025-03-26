<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;

class UserCountWidget extends Widget
{
    protected static string $view = 'filament.resources.user-resource.widgets.user-count-widget';

    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        return [
            'userCount' => User::count(),
        ];
    }
}
