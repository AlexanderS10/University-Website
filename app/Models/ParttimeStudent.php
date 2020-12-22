<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ParttimeStudent
 * 
 * @property string|null $Student_id
 * @property int|null $Credits_taken
 *
 * @package App\Models
 */
class ParttimeStudent extends Model
{
	protected $table = 'Parttime_Student';
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
