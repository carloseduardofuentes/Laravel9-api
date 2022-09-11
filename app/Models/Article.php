<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApplySorts(Builder $query, $sort){
        
        $sortFields=Str::of($sort)->explode(',');

        //$articleQuery=Article::query();

        //dd($sortField);

        foreach($sortFields as $sortField){
            $direction='asc';
            if(Str::of($sortField)->StartsWith('-')){
                $direction='desc';
                $sortField = Str::of($sortField)->substr(1);
                //dd($sortField);
            }
            $query->orderBy($sortField,$direction);
        }
    }
}
