<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarriageCertificateResource\Pages;
use App\Filament\Resources\MarriageCertificateResource\RelationManagers;
use App\Models\MarriageCertificate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MarriageCertificateResource extends Resource
{
    protected static ?string $model = MarriageCertificate::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            Forms\Components\FileUpload::make('photo')
                ->image()
                ->directory('uploads/marriage_certificates')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->sortable()
                ->searchable(),
            Tables\Columns\ImageColumn::make('photo')
                ->disk('public'),
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
            'index' => Pages\ListMarriageCertificates::route('/'),
            'create' => Pages\CreateMarriageCertificate::route('/create'),
            'edit' => Pages\EditMarriageCertificate::route('/{record}/edit'),
        ];
    }
}
