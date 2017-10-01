<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RetweetsData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'retweets_data';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tweet_id', "followers_count"];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
