<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerTextResource\Pages;
use App\Filament\Resources\BannerTextResource\RelationManagers;
use App\Models\BannerText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class BannerTextResource extends Resource
{
    protected static ?string $model = BannerText::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Textarea::make('e_body')->label('English Body')->required(),
            Textarea::make('m_body')->label('Myanmar Body')->required(),
            Textarea::make('t_body')->label('Thai Body')->required(),
            Textarea::make('s_body')->label('Sundanese Body')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('e_body')->limit(50),
            TextColumn::make('m_body')->limit(50),
            TextColumn::make('t_body')->limit(50),
            TextColumn::make('s_body')->limit(50),
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
            'index' => Pages\ListBannerTexts::route('/'),
            'create' => Pages\CreateBannerText::route('/create'),
            'edit' => Pages\EditBannerText::route('/{record}/edit'),
        ];
    }
}
