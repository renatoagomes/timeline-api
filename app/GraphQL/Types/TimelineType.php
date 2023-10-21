<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Timeline;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TimelineType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Timeline',
        'description' => 'A type',
        'model' => Timeline::class
    ];

    public function fields(): array
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
            'events' => [
                'type' => Type::listOf(GraphQL::type('Event')),
                'description' => 'The events of timeline',
            ],
        ];
    }
}
