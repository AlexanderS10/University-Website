<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentHold
 * 
 * @property string|null $Student_id
 * @property string|null $Hold_id
 *
 * @package App\Models
 */
class StudentHold extends Model
{
	protected $table = 'Student_Holds';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Student_id',
		'Hold_id'
	];
}
