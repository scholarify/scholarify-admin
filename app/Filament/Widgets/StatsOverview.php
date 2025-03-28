<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected ?string $heading ='Statistiques';
    protected ?string $description ='An overview of some statistiques';
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Total Revenue (USD)', '12058')
                ->icon('heroicon-o-user')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->description('Since Last month')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Total Schools', '149')
                ->description('1.3% Since last month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Students', '21%')
                ->description('1.34% currently enrolled')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Active Users', '3:12')
                ->description('3% Since last month')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
        ];
    }
}
