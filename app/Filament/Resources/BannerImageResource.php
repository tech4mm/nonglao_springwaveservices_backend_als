<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerImageResource\Pages;
use App\Filament\Resources\BannerImageResource\RelationManagers;
use App\Models\BannerImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;

class BannerImageResource extends Resource
{
    protected static ?string $model = BannerImage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required(),
            FileUpload::make('image')
                ->image() // Specify that the field should handle images
                ->disk('public') // Store the image on the public disk (you can customize this)
                ->directory('banner_images') // Save images in the `banner_images` folder
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('name')->sortable()->searchable(),
            TextColumn::make('image')->label('Image')->limit(50),
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
            'index' => Pages\ListBannerImages::route('/'),
            'create' => Pages\CreateBannerImage::route('/create'),
            'edit' => Pages\EditBannerImage::route('/{record}/edit'),
        ];
    }
}
