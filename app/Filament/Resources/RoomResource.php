<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\RoomType;
use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

final class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function getNavigationBadge(): string
    {
        return (string) Room::query()->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('view')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('accessible')
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options(RoomType::class)
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sleeps')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('size')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('daily_rate')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('weekly_rate')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('floor_id')
                    ->relationship('floor', 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')->hidden(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('label')
                    ->searchable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('view')
                    ->searchable(),
                Tables\Columns\TextColumn::make('accessible')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('sleeps')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('daily_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weekly_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('floor.name'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            RoomResource\RelationManagers\AmenitiesRelationManager::class,
            RoomResource\RelationManagers\BookingsRelationManager::class,
            RoomResource\RelationManagers\FloorRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'view' => Pages\ViewRoom::route('/{record}'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
