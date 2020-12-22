<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Enrollment
 * 
 * @property string|null $Class_crn
 * @property string|null $Student_id
 * @property string|null $Grade
 * @property string|null $Semester_id
 *
 * @package App\Models
 */
class Enrollment extends Model
{
	protected $table = 'Enrollment';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Class_crn',
		'Student_id',
		'Grade',
		'Semester_id'
	];
}
