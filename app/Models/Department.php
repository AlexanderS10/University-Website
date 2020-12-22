<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int|null $Dept_id
 * @property string|null $Dept_name
 * @property string|null $Chair
 * @property string|null $Phone_number
 * @property string|null $Room_id
 * @property string|null $Manager
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'Department';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Dept_id' => 'int'
	];

	protected $fillable = [
		'Dept_id',
		'Dept_name',
		'Chair',
		'Phone_number',
		'Room_id',
		'Manager'
	];
}
