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
                Forms\Components\TextInput::make('thai_phone_no')->label('Thai Phone No')->nullable(),
                Forms\Components\TextInput::make('myan_phone_no')->label('Myanmar Phone No')->nullable(),
                Forms\Components\Textarea::make('thai_address')->label('Thai Address')->nullable(),
                Forms\Components\Textarea::make('myan_address')->label('Myanmar Address')->nullable(),
                Forms\Components\Textarea::make('work_place_address')->label('Workplace Address')->nullable(),
                Forms\Components\TextInput::make('other_name')->label('Other Name')->nullable(),
Forms\Components\Select::make('gender')
    ->label('Gender')
    ->options([
        'male' => 'Male',
        'female' => 'Female',
        'other' => 'Other',
    ])
    ->nullable(),
Forms\Components\DatePicker::make('date_of_birth')->label('Date of Birth')->nullable(),
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
