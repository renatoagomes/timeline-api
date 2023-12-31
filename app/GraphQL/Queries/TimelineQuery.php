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
                'type' => Type::nonNull(GraphQL::type('ID')),
                'description' => 'The id of the timeline'
            ],
            'name' => [
                'type' => GraphQL::type('String'),
                'description' => 'The name of timeline'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Timeline::with($with)->select($select)->where($args)->first();
    }
}
