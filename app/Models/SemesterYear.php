<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SemesterYear
 * 
 * @property string|null $Semester_id
 * @property string|null $Start_Date
 * @property string|null $End_Date
 *
 * @package App\Models
 */
class SemesterYear extends Model
{
	protected $table = 'Semester_Year';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Semester_id',
		'Start_Date',
		'End_Date'
	];
}
