<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaxAddResource\Pages;
use App\Filament\Resources\TaxAddResource\RelationManagers;
use App\Models\TaxAdd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaxAddResource extends Resource
{
    protected static ?string $model = TaxAdd::class;

    public static function getNavigationLabel(): string
    {
        return 'Tax Add'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Others'; // Custom group
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
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->phone} - {$record->name}")
                    ->searchable()
                    ->required(),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                Forms\Components\DatePicker::make('end_date')
                    ->label('End Date')
                    ->required(),

                Forms\Components\FileUpload::make('photo')
                    ->label('Tax Photo')
                    ->directory('tax_photos')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name')->label('User'),
    Tables\Columns\TextColumn::make('start_date')->date(),
    Tables\Columns\TextColumn::make('end_date')->date(),
    Tables\Columns\ImageColumn::make('photo')->label('Photo'),
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
            'index' => Pages\ListTaxAdds::route('/'),
            'create' => Pages\CreateTaxAdd::route('/create'),
            'edit' => Pages\EditTaxAdd::route('/{record}/edit'),
        ];
    }
}
