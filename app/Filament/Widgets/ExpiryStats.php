<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;
use App\Models\User;

class ExpiryStats extends BaseWidget
{
    protected function getStats(): array
    {
        $now = Carbon::now();
        $inOneMonth = $now->copy()->addMonth();
        $in6Days = $now->copy()->addDays(6);

        return [
            Stat::make('Total Register', User::count())
                ->description("Male - " . User::where('gender', 'Male')->count() . " | Female - " . User::where('gender', 'Female')->count()),

            Stat::make('Total Passport Expire (1M-0D)', 99)
                ->color('danger'),

            Stat::make('Total Visa Expire (1M-0D)', 110)
                ->color('danger'),

            Stat::make('Total Work Permit Expire (1M-0D)',50)
                ->color('danger'),

            Stat::make('Total 90 Day Report Expire (6D-0D)', 100)
                ->color('danger')
                ->description("Total 90 Day Report Expire (6D-0D)"),

            // Divider (optional visual break)
            Stat::make('⎯⎯⎯⎯⎯⎯⎯', ''),

            // Circular style dummy data widgets
            Stat::make("Passport Expire\nWithin 1 Months", 100)
                ->color('danger')
                ->description('')
                ->extraAttributes(['class' => 'text-center text-red-600 font-bold']),

            Stat::make("Visa Expire\nWithin 1 Months", 200)
                ->color('danger')
                ->description('')
                ->extraAttributes(['class' => 'text-center text-red-600 font-bold']),

            Stat::make("Work Permit Expire\nWithin 1 Months", 100)
                ->color('danger')
                ->description('')
                ->extraAttributes(['class' => 'text-center text-red-600 font-bold']),

            Stat::make("90 Days Report Expire\nWithin 7 Days", 100)
                ->color('danger')
                ->description('')
                ->extraAttributes(['class' => 'text-center text-red-600 font-bold']),
        ];
    }
}