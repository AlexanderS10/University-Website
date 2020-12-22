<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Undergraduate
 * 
 * @property string|null $Student_id
 * @property string|null $Student_type
 * @property string|null $Standing
 *
 * @package App\Models
 */
class Undergraduate extends Model
{
	protected $table = 'Undergraduate';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Student_id',
		'Student_type',
		'Standing'
	];
}
