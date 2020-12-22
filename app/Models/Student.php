<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * 
 * @property string|null $Student_id
 * @property float|null $Student_GPA
 * @property string|null $Student_type
 * @property Carbon|null $Date
 * @property int|null $Credits
 *
 * @package App\Models
 */
class Student extends Model
{
	protected $table = 'Student';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Student_GPA' => 'float',
		'Credits' => 'int'
	];

	protected $dates = [
		'Date'
	];

	protected $fillable = [
		'Student_id',
		'Student_GPA',
		'Student_type',
		'Date',
		'Credits'
	];
}
