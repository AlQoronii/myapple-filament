<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;


use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    // redirect to index after create
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
