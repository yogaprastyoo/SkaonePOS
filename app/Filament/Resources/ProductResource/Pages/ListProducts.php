<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $tabs = [];

        $tabs['all'] = Tab::make('All')
            ->badge(Product::count());

        $categoryStages = ProductCategory::withCount('products')->get();

        foreach ($categoryStages as $categoryStage) {
            $tabs[$categoryStage->name] = Tab::make()
                ->badge($categoryStage->products_count)
                ->modifyQueryUsing(
                    function (Builder $query) use ($categoryStage) {
                        $query->where('product_category_id', $categoryStage->id);
                    }
                );
        }

        return $tabs;
    }
}
