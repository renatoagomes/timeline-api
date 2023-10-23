<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Tag;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class TagsQuery extends Query
{
    protected $attributes = [
        'name' => 'tags',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Tag'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
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

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        return Tag::query()
            ->select($select)
            ->with($with)
            ->get();
    }
}
