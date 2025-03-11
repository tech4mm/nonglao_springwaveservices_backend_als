<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassportExtensionRequirementResource\Pages;
use App\Filament\Resources\PassportExtensionRequirementResource\RelationManagers;
use App\Models\PassportExtensionRequirement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassportExtensionRequirementResource extends Resource
{
    protected static ?string $model = PassportExtensionRequirement::class;

     public static function getNavigationLabel(): string
    {
        return 'Passport Extension Requirements'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Requirements'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-paper-clip'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('e_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('e_body')
                    ->required(),
                Forms\Components\TextInput::make('m_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('m_body')
                    ->required(),
                Forms\Components\TextInput::make('t_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('t_body')
                    ->required(),
                Forms\Components\TextInput::make('s_title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('s_body')
                    ->required(),
                Forms\Components\Checkbox::make('type')
                    ->label('Type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('e_title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('e_body')->limit(50),
                Tables\Columns\TextColumn::make('m_title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('m_body')->limit(50),
                Tables\Columns\TextColumn::make('t_title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('t_body')->limit(50),
                Tables\Columns\TextColumn::make('s_title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('s_body')->limit(50),
                Tables\Columns\BooleanColumn::make('type')->sortable(),
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
            'index' => Pages\ListPassportExtensionRequirements::route('/'),
            'create' => Pages\CreatePassportExtensionRequirement::route('/create'),
            'edit' => Pages\EditPassportExtensionRequirement::route('/{record}/edit'),
        ];
    }
}
