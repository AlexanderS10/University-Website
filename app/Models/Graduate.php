<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Graduate
 * 
 * @property string|null $Student_id
 * @property string|null $Program
 * @property string|null $Student_type
 *
 * @package App\Models
 */
class Graduate extends Model
{
	protected $table = 'Graduate';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Student_id',
		'Program',
		'Student_type'
	];
}
