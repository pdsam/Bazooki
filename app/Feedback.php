<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $table = 'feedback';

	public $fillable = [
        'ftype',
        'rating',
        'opinion',
        'rater_id',
        'rated_id',
        'transaction_id'
    ];
}
