<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Emri')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\Select::make('category_id')
                    ->label('Kategoria')
                    ->required()
                    ->relationship('category', 'name')
                    ->native(false)
                    ->searchable()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('price')
                    ->label('Cmimi')
                    ->numeric()
                    ->suffix('ALL')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('storage')
                    ->label('Memorja')
                    ->numeric()
                    ->suffix('GB')
                    ->columnSpan('full'),
                Forms\Components\ColorPicker::make('color')
                    ->label('Ngjyra')
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('battery')
                    ->label('Bateria')
                    ->columnSpan('full'),
                Forms\Components\Select::make('manufacturer_id')
                    ->label('Prodhuesi')
                    ->required()
                    ->relationship('manufacturer', 'name')
                    ->native(false)
                    ->searchable()
                    ->columnSpan('full'),
                Forms\Components\Select::make('model_id')
                    ->label('Modeli')
                    ->required()
                    ->options(fn (Forms\Get $get) => ProductModel::where('manufacturer_id', $get('manufacturer_id'))->limit(10)->pluck('name', 'id')->toArray())
                    ->native(false)
                    ->searchable()
                    ->columnSpan('full'),
                Forms\Components\TextInput::make('amount')
                    ->label('Sasia')
                    ->numeric()
                    ->suffix('cope')
                    ->default(1)
                    ->columnSpan('full'),

                Forms\Components\Textarea::make('note')
                    ->label('Shenim')
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Emri')->searchable(),
                Tables\Columns\TextColumn::make('manufacturer.name')->label('Prodhuesi'),
                Tables\Columns\TextColumn::make('model.name')->label('Modeli'),
                Tables\Columns\TextColumn::make('price')->label('Cmimi')->sortable(),
                Tables\Columns\TextColumn::make('amount')->label('Sasia')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
