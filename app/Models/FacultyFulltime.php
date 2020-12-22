<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FacultyFulltime
 * 
 * @property string|null $Faculty_id
 *
 * @package App\Models
 */
class FacultyFulltime extends Model
{
	protected $table = 'Faculty_Fulltime';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Faculty_id'
	];
}
