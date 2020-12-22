<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advisor
 * 
 * @property string|null $Faculty_id
 * @property string|null $Student_id
 * @property Carbon|null $Date_Assigned
 *
 * @package App\Models
 */
class Advisor extends Model
{
	protected $table = 'Advisor';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'Date_Assigned'
	];

	protected $fillable = [
		'Faculty_id',
		'Student_id',
		'Date_Assigned'
	];
}
