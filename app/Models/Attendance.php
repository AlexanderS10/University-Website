<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendance
 * 
 * @property string|null $Student_id
 * @property string|null $Class_crn
 * @property string|null $Att
 *
 * @package App\Models
 */
class Attendance extends Model
{
	protected $table = 'Attendance';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Student_id',
		'Class_crn',
		'Att'
	];
}
