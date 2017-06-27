<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'created_at', 'onboarding_percentage',
    ];

    public $timestamps = false;
}