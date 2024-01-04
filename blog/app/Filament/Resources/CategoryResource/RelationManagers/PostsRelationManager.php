<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;



class PostsRelationManager extends RelationManager
{
    protected static string $relationship = 'posts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('title')
                //     ->required()
                //     ->maxLength(255),
                Card::make()->schema([
                    BelongsToSelect::make('category_id')
                    ->relationship('category','name'),
                    TextInput::make('title')->required()
                    ->afterStateUpdated(function ($set, $state) {
                        $set('slug', Str::slug($state));
                    })->required(),
                    TextInput::make('slug')->required(),
                    RichEditor::make('content'),
                    Toggle::make('is_published')
                ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                // Tables\Columns\TextColumn::make('title'),
                TextColumn::make('id')->sortable(),
                TextColumn::make('title')->limit('50')->sortable()->searchable(),
                TextColumn::make('slug')->limit('50'),
                BooleanColumn::make('is_published')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
