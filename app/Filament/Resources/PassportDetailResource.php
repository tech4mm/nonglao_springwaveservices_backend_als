<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PassportDetailResource\Pages;
use App\Filament\Resources\PassportDetailResource\RelationManagers;
use App\Models\PassportDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PassportDetailResource extends Resource
{
    protected static ?string $model = PassportDetail::class;

    public static function getNavigationLabel(): string
    {
        return 'Passport Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 2; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-paper-clip'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            //    Forms\Components\Select::make('user_id')
            //     ->label('User')
            //     ->relationship('user', 'name')
            //     ->searchable()
            //     ->preload()
            //     ->required(),
            Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->id} - {$record->phone} - {$record->name}")
                    ->searchable()
                    ->required(),

            Forms\Components\FileUpload::make('photo')
                ->disk('public')
                ->directory('uploads/passports')
                ->preserveFilenames()
                ->multiple() // Allows multiple images stored as an array
                ->image()
                ->storeFileNamesIn('photo') // Ensures JSON format
                ->required(),

            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('passport_type')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('passport_number')
                ->required()
                ->maxLength(100),

            Forms\Components\Select::make('gender')
                ->label('Gender')
                ->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ])
                ->required(),

            Forms\Components\DatePicker::make('date_of_birth')
                ->required(),

            Forms\Components\TextInput::make('place_of_birth')
                ->required()
                ->maxLength(255),

            Forms\Components\DatePicker::make('date_of_issue')
                ->required(),

            Forms\Components\TextInput::make('place_of_issue')
                ->required()
                ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user_id')
                ->label('User')
                ->sortable()
                ->searchable(),

            Tables\Columns\ImageColumn::make('photo')
                ->label('Photo')
                ->limit(3), // Show a max of 3 images in the table

            Tables\Columns\TextColumn::make('name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('passport_type')
                ->label('Passport Type')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('passport_number')
                ->label('Passport Number')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('gender')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('date_of_birth')
                ->label('Date of Birth')
                ->sortable(),

            Tables\Columns\TextColumn::make('place_of_birth')
                ->label('Place of Birth')
                ->sortable(),

            Tables\Columns\TextColumn::make('date_of_issue')
                ->label('Date of Issue')
                ->sortable()
                ->date(),

            Tables\Columns\TextColumn::make('place_of_issue')
                ->label('Place of Issue')
                ->sortable(),
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
            'index' => Pages\ListPassportDetails::route('/'),
            'create' => Pages\CreatePassportDetail::route('/create'),
            'edit' => Pages\EditPassportDetail::route('/{record}/edit'),
        ];
    }
}
