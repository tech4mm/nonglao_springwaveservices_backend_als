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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name') // Assuming a relationship with User model
                    ->required(),

                Forms\Components\FileUpload::make('photo')
    ->disk('public') // Ensure it's stored properly
    ->directory('uploads/photos') // Adjust path if necessary
    ->storeFileNamesIn('photo') // Store only the file name if needed
    ->preserveFilenames()
    ->required(),

                Forms\Components\TextInput::make('name'),

                Forms\Components\TextInput::make('gender'),

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
