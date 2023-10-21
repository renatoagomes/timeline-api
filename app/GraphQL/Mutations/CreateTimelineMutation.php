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

class CreateTimelineMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createTimeline',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Timeline');
    }

    public function args(): array
    {
        return [
            'name' => [
                'type' => Type::nonNull(GraphQL::type('String')),
                'description' => 'The name of timeline'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Timeline::create($args);
    }
}
