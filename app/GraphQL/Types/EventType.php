<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Event;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class EventType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Event',
        'description' => 'A type',
        'model' => Event::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(GraphQL::type('ID')),
                'description' => 'The id of the event'
            ],
            'title' => [
                'type' => GraphQL::type('String'),
                'description' => 'The name of event'
            ],
            'description' => [
                'type' => GraphQL::type('String'),
                'description' => 'The description of event'
            ],
            'start_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The start date of event',
            ],
            'end_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The end date of event'
            ],
            'timeline_id' => [
                'type' => GraphQL::type('ID'),
                'description' => 'The timeline id of event'
            ],
        ];
    }
}
