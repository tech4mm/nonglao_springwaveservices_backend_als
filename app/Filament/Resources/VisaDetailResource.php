<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisaDetailResource\Pages;
use App\Filament\Resources\VisaDetailResource\RelationManagers;
use App\Models\VisaDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisaDetailResource extends Resource
{
    protected static ?string $model = VisaDetail::class;

    public static function getNavigationLabel(): string
    {
        return 'Visa Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-check'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label('User')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\FileUpload::make('photo')
    ->disk('public')
    ->directory('uploads/photos')
    ->preserveFilenames()
    ->image()
    ->storeFileNamesIn('photo') // Ensures JSON format
    ->required(),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('gender')
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('passport_number')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('visa_type')
                    ->required()
                    ->maxLength(100),

                Forms\Components\DatePicker::make('visa_issue_date')
                    ->required(),

                Forms\Components\DatePicker::make('visa_expire_date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('User')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('photo')
                    ->label('Photo'),

                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('gender')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('passport_number')
                    ->label('Passport Number')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('visa_type')
                    ->label('Visa Type')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('visa_issue_date')
                    ->label('Visa Issue Date')
                    ->sortable(),

                Tables\Columns\TextColumn::make('visa_expire_date')
                    ->label('Visa Expiry Date')
                    ->sortable()
                    ->date(),
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
            'index' => Pages\ListVisaDetails::route('/'),
            'create' => Pages\CreateVisaDetail::route('/create'),
            'edit' => Pages\EditVisaDetail::route('/{record}/edit'),
        ];
    }
}
