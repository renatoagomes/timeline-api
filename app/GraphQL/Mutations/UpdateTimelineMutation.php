<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Timeline;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class UpdateTimelineMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateTimeline',
        'description' => 'A mutation'
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
                'type' => Type::nonNull(GraphQL::type('String')),
                'description' => 'The name of timeline'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $timeline = Timeline::findOrFail($args['id']);

        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $timeline->fill($args);
        $timeline->save();

        return $timeline->refresh()->load($with);
    }
}
