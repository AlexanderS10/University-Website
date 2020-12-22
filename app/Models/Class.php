<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Class
 * 
 * @property int|null $Class_crn
 * @property string|null $Crs_id
 * @property string|null $Faculty_id
 * @property string|null $Class_Section
 * @property string|null $Room_id
 * @property string|null $Semester_id
 * @property string|null $Timeslot_id
 *
 * @package App\Models
 */
class Class extends Model
{
	protected $table = 'Class';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Class_crn' => 'int'
	];

	protected $fillable = [
		'Class_crn',
		'Crs_id',
		'Faculty_id',
		'Class_Section',
		'Room_id',
		'Semester_id',
		'Timeslot_id'
	];
}
