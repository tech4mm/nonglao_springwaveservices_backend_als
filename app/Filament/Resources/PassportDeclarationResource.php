<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassportDeclarationResource\Pages;
use App\Filament\Resources\PassportDeclarationResource\RelationManagers;
use App\Models\PassportDeclaration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassportDeclarationResource extends Resource
{
    protected static ?string $model = PassportDeclaration::class;

    public static function getNavigationLabel(): string
    {
        return 'Certificate of Lost Passport Declaration'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Recommendation Letter'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 4; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-user-group'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('e_title')->required(),
            Forms\Components\Textarea::make('e_body')->required(),
            Forms\Components\TextInput::make('m_title')->required(),
            Forms\Components\Textarea::make('m_body')->required(),
            Forms\Components\TextInput::make('t_title')->required(),
            Forms\Components\Textarea::make('t_body')->required(),
            Forms\Components\TextInput::make('s_title')->required(),
            Forms\Components\Textarea::make('s_body')->required(),
            Forms\Components\Toggle::make('type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                            Tables\Columns\TextColumn::make('e_title')->searchable(),
            Tables\Columns\TextColumn::make('m_title'),
            Tables\Columns\IconColumn::make('type')->boolean(),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListPassportDeclarations::route('/'),
            'create' => Pages\CreatePassportDeclaration::route('/create'),
            'edit' => Pages\EditPassportDeclaration::route('/{record}/edit'),
        ];
    }
}
