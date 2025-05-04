<?php

namespace App\Http\Filters;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PostFilter extends AbstractFilter
{
    protected array $keys = [
        'title',
        'content',
        'category_id',
        'published_at_from',
        'published_at_to',
        'profile_id',
        'is_published',
    ];

    protected function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%$value%");
    }

    protected function content(Builder $builder, $value)
    {
        $builder->where('content', 'ilike', "%$value%");
    }

    protected function categoryId(Builder $builder, $value)
    {
        $builder->whereRelation('category', 'title','ilike',  "%$value%");
    }

    protected function profileId(Builder $builder, $value)
    {
//        $builder->whereRelation('profiles', 'id','=',$value);
        $builder->where('profile_id', '=', $value);

    }

    protected function publishedAtFrom(Builder $builder, $value)
    {
        $builder->where('published_at', '>=', "%$value%");
    }
    protected function publishedAtTo(Builder $builder, $value)
    {
        $builder->where('published_at', '<=', "%$value%");
    }

    protected function isPublished(Builder $builder, $value)
    {
        $builder->where('is_published', '=', "%$value%");
    }

}
