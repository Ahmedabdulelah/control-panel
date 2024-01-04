<?php

namespace App\Filament\Resources\PostResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;


class StateOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('All posts',post::all()->count())
        ];
    }
}

