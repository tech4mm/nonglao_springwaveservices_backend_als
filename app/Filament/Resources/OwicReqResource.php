<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwicReqResource\Pages;
use App\Filament\Resources\OwicReqResource\RelationManagers;
use App\Models\OwicReq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwicReqResource extends Resource
{
    protected static ?string $model = OwicReq::class;
    public static function shouldRegisterNavigation(): bool
{
    return false;
}

    public static function getNavigationLabel(): string
    {
        return 'OWIC Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Others'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 5; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-puzzle-piece'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->phone} - {$record->name}")
                    ->searchable()
                    ->required(),

            Forms\Components\TextInput::make('name')
                ->required(),

            Forms\Components\Select::make('gender')
                ->required()
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ]),

            Forms\Components\TextInput::make('owic_number')
                ->required(),

            Forms\Components\FileUpload::make('photos')
                ->label('OWIC Photos')
                ->multiple()
                ->directory('owic_photos')
                ->reorderable()
                ->preserveFilenames()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('owic_number')->searchable(),
                Tables\Columns\ImageColumn::make('photos')
                    ->label('Photos')
                    ->limit(3)
                    ->stacked()
                    ->circular(),
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
            'index' => Pages\ListOwicReqs::route('/'),
            'create' => Pages\CreateOwicReq::route('/create'),
            'edit' => Pages\EditOwicReq::route('/{record}/edit'),
        ];
    }
}
