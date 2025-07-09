<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\HasMany;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;

/**
 * @extends ModelResource<Order>
 */
class OrderResource extends ModelResource
{
    protected string $model = Order::class;

    protected string $title = 'Orders';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User', formatted: 'name')->sortable(),
            HasMany::make('Books', resource: BookResource::class)
                ->relatedLink(condition: function (int $count, Field $field): bool {
                    return $count > 10;
                }),
            Number::make('Total cost', 'total_cost'),
            Select::make('Status')
                ->options(Order::STATUSES)
                ->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make('User', formatted: 'name')->disabled(),
            HasMany::make('Books', resource: BookResource::class)
                ->relatedLink(condition: function (int $count, Field $field): bool {
                    return $count > 10;
                })
                ->disabled(),
            Number::make('Total cost', 'total_cost')->disabled(),
            Select::make('Status')
                ->options(Order::STATUSES),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            BelongsTo::make('User', formatted: 'name')->disabled(),
            HasMany::make('Books', resource: BookResource::class)
                ->relatedLink(condition: function (int $count, Field $field): bool {
                    return $count > 10;
                })
                ->disabled(),
            Number::make('Total cost', 'total_cost')->disabled(),
            Select::make('Status')
                ->options(Order::STATUSES),
        ];
    }

    /**
     * @param Order $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
