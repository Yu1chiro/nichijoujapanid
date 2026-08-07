<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\ViewField;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => 
                    $operation === 'create' ? $set('slug', Str::slug($state)) : null
                ),

            Forms\Components\TextInput::make('slug')
                ->required()
                ->unique(ignoreRecord: true)
                ->helperText('Otomatis di-generate sistem'),

            Forms\Components\Select::make('category')
                ->options([
                    'Insight' => 'Insight',
                    'Culture' => 'Culture',
                    'Work' => 'Work',
                    'News' => 'News',
                ])
                ->required(),

            // Menggunakan komponen custom ImageKit Anda
            ViewField::make('thumbnail_url')
                ->view('filament.forms.components.image-kit-uploader')
                ->label('Upload Thumbnail (WebP format)')->columnSpanFull(),

            // Rich Editor Filament 
            Forms\Components\RichEditor::make('description')
                ->label('Isi Artikel')
                ->toolbarButtons([
                    'blockquote',
                    'bold',
                    'bulletList',
                    'h2',
                    'h3',
                    'italic',
                    'link',
                    'orderedList',
                    'redo',
                    'strike',
                    'underline',
                    'undo',
                ])
                ->required()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url')->label('Thumbnail')->size(60),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\BadgeColumn::make('category')->colors([
                    'primary' => 'Insight',
                    'success' => 'Culture',
                    'warning' => 'Work',
                    'danger' => 'News',
                ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}