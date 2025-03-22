<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrivacyPolicyResource\Pages;
use App\Filament\Resources\PrivacyPolicyResource\RelationManagers;
use App\Models\PrivacyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

class PrivacyPolicyResource extends Resource
{
    protected static ?string $model = PrivacyPolicy::class;

    public static function getNavigationLabel(): string
    {
        return 'Privacy Policy'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Admin Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-eye-slash'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                RichEditor::make('body')
                ->label('Privacy Policy Body')
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
                ->label('Privacy Policy Body')
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
            'index' => Pages\ListPrivacyPolicies::route('/'),
            'create' => Pages\CreatePrivacyPolicy::route('/create'),
            'edit' => Pages\EditPrivacyPolicy::route('/{record}/edit'),
        ];
    }
}
