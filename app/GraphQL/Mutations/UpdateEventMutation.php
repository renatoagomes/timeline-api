<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Event;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateEventMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateEvent',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Event');
    }

    public function args(): array
    {
        return [
            'event' => [
                'type' => GraphQL::type('UpdateEventInput'),
                'description' => 'The event to be updated'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $event = Event::findOrFail($args['event']['id']);

        $fields = $getSelectFields();
        $with = $fields->getRelations();

        $event->fill($args['event']);
        $event->save();

        return $event->refresh()->load($with);
    }
}
