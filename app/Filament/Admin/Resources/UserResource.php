<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                // Ganti ImageInput dengan FileUpload untuk mendukung upload gambar
                Forms\Components\FileUpload::make('picture_path')
                    ->image() // Memastikan hanya file gambar yang diterima
                    ->label('Image')
                    ->required() // Menjadikan field ini wajib diisi
                    ->maxSize(1024) // Maksimum ukuran file dalam KB (1MB)
                    ->directory('images') // Folder tempat gambar disimpan
                    ->visibility('public') // Tentukan visibilitas file (misalnya 'public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']), // Hanya tipe gambar yang diterima
                Forms\Components\TextInput::make('role')
                    ->default('user')
                    ->required()
                    ->maxLength(255),
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->limit(50),
                Tables\Columns\TextColumn::make('email')
                    ->limit(50),
                Tables\Columns\TextColumn::make('role')
                    ->limit(50),
                Tables\Columns\ImageColumn::make('picture_path')
                    ->label('picture'),
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
            'index' => Pages\ListUser::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}edit'),
        ];
    }
}
