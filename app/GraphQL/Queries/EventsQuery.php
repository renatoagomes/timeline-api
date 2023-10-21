<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Event;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class EventsQuery extends Query
{
    protected $attributes = [
        'name' => 'events',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Event'));
    }

    public function args(): array
    {
        return [
            // 'id' => [
            //     'type' => GraphQL::type('ID'),
            //     'description' => 'The id of the event'
            // ],
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
                'description' => 'The start date of event'
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

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $query = Event::query()->select($select)->with($with);

        if (isset($args['timeline_id'])) {
            $query->where('timeline_id', $args['timeline_id']);
        }
        if (isset($args['id'])) {
            $query->where('id', $args['id']);
        }
        if (isset($args['title'])) {
            $query->where('title', 'like', "%".$args['title']."%");
        }
        if (isset($args['description'])) {
            $query->where('description', 'like', "%".$args['description']."%");
        }
        if (isset($args['start_date'])) {
            $query->whereDate('start_date', '>=', $args['start_date']);
        }
        if (isset($args['end_date'])) {
            $query->where('end_date', '<=', $args['end_date']);
        }

        return $query->get();
    }
}
