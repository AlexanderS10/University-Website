<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentMajor
 * 
 * @property string|null $Major_id
 * @property string|null $Student_id
 * @property Carbon|null $Date
 *
 * @package App\Models
 */
class StudentMajor extends Model
{
	protected $table = 'Student_Major';
	public $incrementing = false;
	public $timestamps = false;

	protected $dates = [
		'Date'
	];

	protected $fillable = [
		'Major_id',
		'Student_id',
		'Date'
	];
}
