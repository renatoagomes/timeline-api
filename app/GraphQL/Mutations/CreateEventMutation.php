<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Event;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class CreateEventMutation extends Mutation
{
    protected $attributes = [
        'name' => 'createEvent',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Event');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(GraphQL::type('String')),
                'description' => 'The name of event'
            ],
            'description' => [
                'type' => Type::nonNull(GraphQL::type('String')),
                'description' => 'The description of event'
            ],
            'start_date' => [
                'type' => Type::nonNull(GraphQL::type('String')),
                'description' => 'The start date of event'
            ],
            'end_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The end date of event'
            ],
            'timeline_id' => [
                'type' => Type::nonNull(GraphQL::type('ID')),
                'description' => 'The id of the timeline'
            ],

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Event::create($args);
    }
}
