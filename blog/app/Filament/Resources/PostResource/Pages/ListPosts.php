<?php

namespace App\Filament\Resources\PostResource\Pages;

// use App\Filament\Resources\StatsOverview;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         StatsOverview::class
    //     ];
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
