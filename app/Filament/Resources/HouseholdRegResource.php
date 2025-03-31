<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HouseholdRegResource\Pages;
use App\Filament\Resources\HouseholdRegResource\RelationManagers;
use App\Models\HouseholdReg;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseholdRegResource extends Resource
{
    protected static ?string $model = HouseholdReg::class;

   public static function getNavigationLabel(): string
    {
        return 'Household Registration'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Others'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-puzzle-piece'; // Icon (from Heroicons)
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

                    Forms\Components\FileUpload::make('photos')
                        ->label('Photos')
                        ->multiple()
                        ->directory('household_photos')
                        ->reorderable()
                        ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name')->label('User'),
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
            'index' => Pages\ListHouseholdRegs::route('/'),
            'create' => Pages\CreateHouseholdReg::route('/create'),
            'edit' => Pages\EditHouseholdReg::route('/{record}/edit'),
        ];
    }
}
