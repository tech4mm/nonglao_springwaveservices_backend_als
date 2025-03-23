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

   public static function getNavigationLabel(): string
    {
        return 'Marriage Certificate'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Info Panel'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 6; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-sparkles'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListMarriageCertificates::route('/'),
            'create' => Pages\CreateMarriageCertificate::route('/create'),
            'edit' => Pages\EditMarriageCertificate::route('/{record}/edit'),
        ];
    }
}
