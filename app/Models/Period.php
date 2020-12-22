<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Period
 * 
 * @property int|null $Period
 * @property string|null $Start_Time
 * @property string|null $End_Time
 *
 * @package App\Models
 */
class Period extends Model
{
	protected $table = 'Period';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Period' => 'int'
	];

	protected $fillable = [
		'Period',
		'Start_Time',
		'End_Time'
	];
}
