<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UidReqResource\Pages;
use App\Filament\Resources\UidReqResource\RelationManagers;
use App\Models\UidReq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UidReqResource extends Resource
{
    protected static ?string $model = UidReq::class;
    public static function shouldRegisterNavigation(): bool
{
    return false;
}

    public static function getNavigationLabel(): string
    {
        return 'UID Information'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Others'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 3; // Sorting order (lower values appear first)
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

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ]),

                Forms\Components\TextInput::make('uid_number')
                    ->required()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                    ->label('Photo')
                    ->directory('uid_photos')
                    ->image()
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('gender')->sortable(),
                Tables\Columns\TextColumn::make('uid_number')->searchable(),
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
            'index' => Pages\ListUidReqs::route('/'),
            'create' => Pages\CreateUidReq::route('/create'),
            'edit' => Pages\EditUidReq::route('/{record}/edit'),
        ];
    }
}
