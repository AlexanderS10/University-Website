<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FulltimeStudent
 * 
 * @property string|null $Student_id
 * @property int|null $Credits_taken
 *
 * @package App\Models
 */
class FulltimeStudent extends Model
{
	protected $table = 'Fulltime_Student';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Credits_taken' => 'int'
	];

	protected $fillable = [
		'Student_id',
		'Credits_taken'
	];
}
