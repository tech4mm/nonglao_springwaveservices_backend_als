<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaExtensionRequirementResource\Pages;
use App\Filament\Resources\VisaExtensionRequirementResource\RelationManagers;
use App\Models\VisaExtensionRequirement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;  // Correct import
use Filament\Tables\Columns\BooleanColumn;

class VisaExtensionRequirementResource extends Resource
{
    protected static ?string $model = VisaExtensionRequirement::class;

     public static function getNavigationLabel(): string
    {
        return 'Visa Extension Requirements'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Requirements'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-check'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('e_title')->required(),
            Textarea::make('e_body')->required(),
            TextInput::make('m_title')->required(),
            Textarea::make('m_body')->required(),
            TextInput::make('t_title')->required(),
            Textarea::make('t_body')->required(),
            TextInput::make('s_title')->required(),
            Textarea::make('s_body')->required(),
            Forms\Components\Toggle::make('type')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('e_title')->sortable()->searchable(),
            TextColumn::make('e_body')->limit(50),
            TextColumn::make('m_title')->sortable()->searchable(),
            TextColumn::make('m_body')->limit(50),
            TextColumn::make('t_title')->sortable()->searchable(),
            TextColumn::make('t_body')->limit(50),
            TextColumn::make('s_title')->sortable()->searchable(),
            TextColumn::make('s_body')->limit(50),
            BooleanColumn::make('type')->sortable(),
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
            'index' => Pages\ListVisaExtensionRequirements::route('/'),
            'create' => Pages\CreateVisaExtensionRequirement::route('/create'),
            'edit' => Pages\EditVisaExtensionRequirement::route('/{record}/edit'),
        ];
    }
}
