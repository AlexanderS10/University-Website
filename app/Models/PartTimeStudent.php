<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PartTimeStudent
 * 
 * @property string|null $Student_id
 * @property int|null $Year_of_study
 *
 * @package App\Models
 */
class PartTimeStudent extends Model
{
	protected $table = 'Part_Time_Student';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Year_of_study' => 'int'
	];

	protected $fillable = [
		'Student_id',
		'Year_of_study'
	];
}
