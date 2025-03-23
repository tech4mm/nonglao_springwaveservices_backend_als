<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkPermitDetailResource\Pages;
use App\Filament\Resources\WorkPermitDetailResource\RelationManagers;
use App\Models\WorkPermitDetail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkPermitDetailResource extends Resource
{
    protected static ?string $model = WorkPermitDetail::class;

    public static function getNavigationLabel(): string
    {
        return 'Worker Permit Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 4; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-briefcase'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('user_id')
                // ->label('User')
                // ->relationship('user', 'name')
                // ->searchable()
                // ->preload()
                // ->required(),
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
                    ->directory('uploads/photos')
                    ->storeFileNamesIn('photo') // Will store array of filenames
                    ->preserveFilenames()
                    ->multiple()
                    ->image()
                    ->required(),

                Forms\Components\TextInput::make('name'),

                Forms\Components\Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('passport_number'),

                Forms\Components\TextInput::make('visa_type')->required(),

                Forms\Components\DatePicker::make('work_permit_issue_date')->required(),

                Forms\Components\DatePicker::make('work_permit_expire_date'),
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

                Tables\Columns\TextColumn::make('work_permit_issue_date')
                    ->label('Work Permit Issue Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('work_permit_expire_date')
                    ->label('Work Permit Expiry Date')
                    ->date()
                    ->sortable()
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
            'index' => Pages\ListWorkPermitDetails::route('/'),
            'create' => Pages\CreateWorkPermitDetail::route('/create'),
            'edit' => Pages\EditWorkPermitDetail::route('/{record}/edit'),
        ];
    }
}
