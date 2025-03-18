<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkerInfoResource\Pages;
use App\Filament\Resources\WorkerInfoResource\RelationManagers;
use App\Models\WorkerInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkerInfoResource extends Resource
{
    protected static ?string $model = WorkerInfo::class;

    public static function getNavigationLabel(): string
    {
        return 'Worker Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // Sorting order (lower values appear first)
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
                ->required(),
                Forms\Components\TextInput::make('passport_no')->required(),
                Forms\Components\DatePicker::make('date_of_issue')->required(),
                Forms\Components\TextInput::make('place_of_issue')->required(),
                Forms\Components\TextInput::make('company_name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user_id'),
                Tables\Columns\TextColumn::make('passport_no'),
                Tables\Columns\TextColumn::make('date_of_issue'),
                Tables\Columns\TextColumn::make('company_name'),
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
            'index' => Pages\ListWorkerInfos::route('/'),
            'create' => Pages\CreateWorkerInfo::route('/create'),
            'edit' => Pages\EditWorkerInfo::route('/{record}/edit'),
        ];
    }
}
