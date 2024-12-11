<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Filament\Admin\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('category')
                            ->label('Category')
                            ->required()
                            ->autofocus()
                            ->placeholder('Enter category name'),
    
                        Grid::make(2) // Membuat grid 2 kolom untuk meletakkan treatment dan description dalam satu baris
                            ->schema([
                                Textarea::make('description')
                                    ->label('Description')
                                    ->required()
                                    ->placeholder('Masukkan deskripsi untuk kategori ini')
                                    ->columnSpan(1)
                                    ->extraAttributes(['style' => 'width: 100%; height: 150px;']), // Mengatur width dan height
                                
                                Textarea::make('treatment')
                                    ->label('Treatment')
                                    ->required()
                                    ->placeholder('Masukkan cara penanganan untuk kategori ini')
                                    ->columnSpan(1)
                                    ->extraAttributes(['style' => 'width: 100%; height: 150px;']), // Mengatur width dan height

                                
                            ]),
                    ])
                    ->columns(1), // Set agar Card menggunakan 1 kolom untuk konsistensi
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn() => Category::query()->latest())
            ->columns([
                // add column
                Tables\Columns\TextColumn::make('category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('treatment')
                    ->wrap()
                    ->limit(25),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
                    ->limit(50),
            ])
            ->filters([

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
