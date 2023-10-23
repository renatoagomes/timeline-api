<?php

declare(strict_types=1);

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\InputType;

class UpdateEventInput extends InputType
{
    protected $attributes = [
        'name' => 'UpdateEventInput',
        'description' => 'An example input',
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
                'description' => 'The date of event'
            ],
            'end_date' => [
                'type' => GraphQL::type('String'),
                'description' => 'The date of event'
            ],
            // 'tags' => [
            //     'type' => Type::listOf(GraphQL::type('Tag')),
            //     'description' => 'The tags of event'
            // ],
        ];
    }
}
