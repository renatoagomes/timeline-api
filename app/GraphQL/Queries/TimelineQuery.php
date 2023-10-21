<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Timeline;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class TimelineQuery extends Query
{
    protected $attributes = [
        'name' => 'timeline',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Timeline');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => GraphQL::type('ID'),
                'description' => 'The id of the timeline'
            ],
            'name' => [
                'type' => GraphQL::type('String'),
                'description' => 'The name of timeline'
            ],
            'description' => [
                'type' => GraphQL::type('String'),
                'description' => 'The description of timeline'
            ],
            'start_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The start date of timeline'
            ],
            'end_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The end date of timeline'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Timeline::where('id', $args['id'])->first();
    }
}
