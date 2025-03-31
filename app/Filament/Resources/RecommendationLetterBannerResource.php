<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecommendationLetterBannerResource\Pages;
use App\Filament\Resources\RecommendationLetterBannerResource\RelationManagers;
use App\Models\RecommendationLetterBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;

class RecommendationLetterBannerResource extends Resource
{
    protected static ?string $model = RecommendationLetterBanner::class;

    public static function getNavigationLabel(): string
    {
        return 'Banner'; // Custom text
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Recommendation Letter'; // Custom group
    }

    public static function getNavigationSort(): ?int
    {
        return 1; // Sorting order (lower values appear first)
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-document-text'; // Icon (from Heroicons)
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                FileUpload::make('photo')
            ->image()
            ->directory('recommendation-banners')
            ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                ImageColumn::make('photo')->label('Banner')->circular(),
        Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
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
            'index' => Pages\ListRecommendationLetterBanners::route('/'),
            'create' => Pages\CreateRecommendationLetterBanner::route('/create'),
            'edit' => Pages\EditRecommendationLetterBanner::route('/{record}/edit'),
        ];
    }
}
