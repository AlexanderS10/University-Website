<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentMinor
 * 
 * @property string|null $Minor_id
 * @property string|null $Student_id
 * @property Carbon|null $Date
 *
 * @package App\Models
 */
class StudentMinor extends Model
{
	protected $table = 'Student_Minor';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'Date'
	];

	protected $fillable = [
		'Minor_id',
		'Student_id',
		'Date'
	];
}
