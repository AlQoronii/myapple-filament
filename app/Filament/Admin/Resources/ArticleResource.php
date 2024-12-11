<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Grid::make(2) // Create a 2-column grid to place title and content in one row
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->autofocus()
                                    ->placeholder('Enter article title'),
                                Forms\Components\TextInput::make('source')
                                    ->label('Sumber Artikel')
                                    ->required()
                                    ->placeholder('Enter article source'),
                            ]),
                        Forms\Components\Textarea::make('content')
                            ->label('Isi Content')
                            ->required()
                            ->placeholder('Enter article content')
                            ->extraAttributes(['style' => 'width: 100%; height: 150px;']), // Set width and height
                        Forms\Components\FileUpload::make('image_path')
                            ->disk('public')    
                            ->label('Image')
                            ->directory('articles')
                            ->required()
                            ->visibility('public')
                            ->image(),
                        
                        
                        Forms\Components\DatePicker::make('publication_date')
                            ->label('Tanggal Publikasi')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(50),
                Tables\Columns\TextColumn::make('content')
                    ->wrap()
                    ->limit(100),
                //imagecolumn
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image'),
                Tables\Columns\TextColumn::make('source')
                    ->limit(50),
                Tables\Columns\TextColumn::make('publication_date')
                    ->date('Y-m-d'), // Format tanggal
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
            'index' => Pages\ListArticle::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
