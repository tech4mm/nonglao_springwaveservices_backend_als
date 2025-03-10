<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPermitRequirementResource\Pages;
use App\Filament\Resources\WorkPermitRequirementResource\RelationManagers;
use App\Models\WorkPermitRequirement;
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

class WorkPermitRequirementResource extends Resource
{
    protected static ?string $model = WorkPermitRequirement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            'index' => Pages\ListWorkPermitRequirements::route('/'),
            'create' => Pages\CreateWorkPermitRequirement::route('/create'),
            'edit' => Pages\EditWorkPermitRequirement::route('/{record}/edit'),
        ];
    }
}
