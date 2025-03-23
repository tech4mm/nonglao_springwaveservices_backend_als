<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TermsConditionResource\Pages;
use App\Filament\Resources\TermsConditionResource\RelationManagers;
use App\Models\TermsCondition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

class TermsConditionResource extends Resource
{
    protected static ?string $model = TermsCondition::class;

    public static function getNavigationLabel(): string
    {
        return 'Terms And Conditions'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Admin Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-command-line'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                RichEditor::make('body')
                ->label('Terms & Conditions Body')
                ->columnSpan(2)
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('body')
                ->label('Terms & Conditions Body')
                ->limit(50), // Display the first 50 characters in the table
            TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListTermsConditions::route('/'),
            'create' => Pages\CreateTermsCondition::route('/create'),
            'edit' => Pages\EditTermsCondition::route('/{record}/edit'),
        ];
    }
}
