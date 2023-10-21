<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class EventQuery extends Query
{
    protected $attributes = [
        'name' => 'event',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Event');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => GraphQL::type('ID'),
                'description' => 'The id of the event'
            ],
            'name' => [
                'type' => GraphQL::type('String'),
                'description' => 'The name of event'
            ],
            'description' => [
                'type' => GraphQL::type('String'),
                'description' => 'The description of event'
            ],
            'start_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The start date of event'
            ],
            'end_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The end date of event'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Event::where('id', $args['id'])->first();
    }
}
