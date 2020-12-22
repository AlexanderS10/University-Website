<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentHistory
 * 
 * @property string|null $Student_id
 * @property string|null $Class_crn
 * @property string|null $Grade
 * @property string|null $Semester_id
 *
 * @package App\Models
 */
class StudentHistory extends Model
{
	protected $table = 'Student_History';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Student_id',
		'Class_crn',
		'Grade',
		'Semester_id'
	];
}
