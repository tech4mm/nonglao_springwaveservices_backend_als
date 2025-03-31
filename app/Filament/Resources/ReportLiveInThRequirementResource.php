<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportLiveInThRequirementResource\Pages;
use App\Filament\Resources\ReportLiveInThRequirementResource\RelationManagers;
use App\Models\ReportLiveInThRequirement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;

class ReportLiveInThRequirementResource extends Resource
{
    protected static ?string $model = ReportLiveInThRequirement::class;

    public static function getNavigationLabel(): string
    {
        return 'Report That You Live In Thailand'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Requirements'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 6; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-briefcase'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('e_title')->required(),
                Textarea::make('e_body')->required(),

                TextInput::make('m_title')->required(),
                Textarea::make('m_body')->required(),

                TextInput::make('t_title')->required(),
                Textarea::make('t_body')->required(),

                TextInput::make('s_title')->required(),
                Textarea::make('s_body')->required(),

                Toggle::make('type')->label('Is Para?'), // This will be a checkbox    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('e_title')->label('English Title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('m_title')->label('Myanmar Title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('t_title')->label('Thai Title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('s_title')->label('Shan Title')->searchable()->sortable(),
                // Tables\Columns\IconColumn::make('type')
                //     ->label('Is Para?')
                //     ->boolean(),
                // Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListReportLiveInThRequirements::route('/'),
            'create' => Pages\CreateReportLiveInThRequirement::route('/create'),
            'edit' => Pages\EditReportLiveInThRequirement::route('/{record}/edit'),
        ];
    }
}
