<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FacultyParttime
 * 
 * @property string|null $Faculty_id
 *
 * @package App\Models
 */
class FacultyParttime extends Model
{
	protected $table = 'Faculty_Parttime';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Faculty_id'
	];
}
