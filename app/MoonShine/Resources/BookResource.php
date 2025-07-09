<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

use MoonShine\CKEditor\Fields\CKEditor;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Text;

/**
 * @extends ModelResource<Book>
 */
class BookResource extends ModelResource
{
    protected string $model = Book::class;

    protected string $title = 'Books';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Publication Year', 'publication_year')->sortable(),
            BelongsTo::make('Author', formatted: fn($author) => "$author->name $author->surname")->sortable(),
            BelongsTo::make('Genre', formatted: 'name')->sortable(),
            Number::make('Price')->sortable(),
            Number::make('Count')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Text::make('Title'),
            Image::make('Cover')
                ->dir('covers')
                ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                ->removable()
                ->nullable(),
            CKEditor::make('Description')->nullable(),
            Text::make('Publication Year', 'publication_year'),
            BelongsTo::make('Author', formatted: fn($author) => "$author->name $author->surname"),
            BelongsTo::make('Genre', formatted: 'name'),
            Number::make('Price'),
            Number::make('Count'),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Image::make('Cover'),
            CKEditor::make('Description'),
            Text::make('Publication Year', 'publication_year'),
            BelongsTo::make('Author', formatted: fn($author) => "$author->name $author->surname"),
            BelongsTo::make('Genre', formatted: 'name'),
            Number::make('Price'),
            Number::make('Count'),
        ];
    }

    protected function search(): array
    {
        return [
            'title',
            'description',
            'publication_year'
        ];
    }

    /**
     * @param Book $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [];
    }
}
