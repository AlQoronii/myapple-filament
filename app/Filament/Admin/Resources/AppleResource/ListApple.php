<?php

namespace App\Filament\Admin\Resources\AppleResource\Pages;

use App\Filament\Admin\Resources\AppleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApple extends ListRecords
{
    protected static string $resource = AppleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
