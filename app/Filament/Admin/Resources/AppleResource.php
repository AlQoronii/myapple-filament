<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AppleResource\Pages;
use App\Models\Apple;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppleResource extends Resource
{
    protected static ?string $model = Apple::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('Pemilik')
                ->relationship('user', 'name')
                ->default(auth()->id())
                ->disabled() // Membuat dropdown tidak bisa diubah
                ->required(),
                Forms\Components\TextInput::make('nama_apel')
                    ->required()
                    ->label('Nama Apel')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // Relasi ke nama user
                ->label('Pemilik'),
                Tables\Columns\TextColumn::make('nama_apel')
                    ->label('Nama Apel')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApple::route('/'),
            'create' => Pages\CreateApple::route('/create'),
            'edit' => Pages\EditApple::route('/{record}/edit'),
        ];
    }
}
