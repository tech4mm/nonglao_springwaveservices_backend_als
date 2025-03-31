<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RegistrationInfoResource\Pages;
use App\Filament\Resources\RegistrationInfoResource\RelationManagers;
use App\Models\RegistrationInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RegistrationInfoResource extends Resource
{
    protected static ?string $model = RegistrationInfo::class;

    public static function getNavigationLabel(): string
    {
        return 'NRC Information ‌'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Others'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-puzzle-piece'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->phone} - {$record->name}")
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ]),
                Forms\Components\TextInput::make('nrc_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photos')
                    ->label('Photos')
                    ->multiple()
                    ->directory('registration_photos')
                    ->reorderable()
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gender')->sortable(),
                Tables\Columns\TextColumn::make('nrc_number')->searchable(),
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
            'index' => Pages\ListRegistrationInfos::route('/'),
            'create' => Pages\CreateRegistrationInfo::route('/create'),
            'edit' => Pages\EditRegistrationInfo::route('/{record}/edit'),
        ];
    }
}
