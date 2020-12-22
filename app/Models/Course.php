<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int|null $Crs_id
 * @property string|null $Dept_id
 * @property string|null $Crs_title
 * @property string|null $Crs_description
 * @property string|null $Crs_credit
 * @property string|null $Grade
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'Course';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Crs_id' => 'int'
	];

	protected $fillable = [
		'Crs_id',
		'Dept_id',
		'Crs_title',
		'Crs_description',
		'Crs_credit',
		'Grade'
	];
}
