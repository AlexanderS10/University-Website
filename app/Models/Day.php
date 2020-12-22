<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Day
 * 
 * @property string|null $Day_of_week
 *
 * @package App\Models
 */
class Day extends Model
{
	protected $table = 'Day';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Day_of_week'
	];
}
