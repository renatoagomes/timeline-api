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

class TimelinesQuery extends Query
{
    protected $attributes = [
        'name' => 'timelines',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Timeline'));
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
            // 'events' => [
            //     'type' => GraphQL::type('Event'),
            //     'description' => 'The events of timeline'
            // ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        logger(__METHOD__, [
            'select' => $select,
            'with' => $with,
            'args' => $args
        ]);

        $query = Timeline::with($with)->select($select)->where($args);

        return $query->get();
    }
}
