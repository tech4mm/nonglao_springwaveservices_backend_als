<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NinetyDayInfoResource\Pages;
use App\Filament\Resources\NinetyDayInfoResource\RelationManagers;
use App\Models\NinetyDayInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NinetyDayInfoResource extends Resource
{
    protected static ?string $model = NinetyDayInfo::class;

    public static function getNavigationLabel(): string
    {
        return '90 Days Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 5; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-calendar-days'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('user_id')
                //     ->label('User')
                //     ->relationship('user', 'name')
                //     ->searchable()
                //     ->preload()
                //     ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->phone} - {$record->name}")
                    ->searchable()
                    ->required(),
                Forms\Components\FileUpload::make('photo')
                    ->image()
                    ->directory('uploads/photos')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('nationality')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('issure_date')
                    ->required(),
                Forms\Components\DatePicker::make('expire_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('photo')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationality')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('issure_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expire_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListNinetyDayInfos::route('/'),
            'create' => Pages\CreateNinetyDayInfo::route('/create'),
            'edit' => Pages\EditNinetyDayInfo::route('/{record}/edit'),
        ];
    }
}
