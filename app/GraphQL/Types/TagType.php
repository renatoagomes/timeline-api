<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Tag;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class TagType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Tag',
        'description' => 'A type',
        'model' => Tag::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the tag'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of tag'
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of tag'
            ],
            'type' => [
                'type' => Type::string(),
                'description' => 'The type of tag'
            ],
        ];
    }
}
