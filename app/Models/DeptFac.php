<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeptFac
 * 
 * @property string|null $Dept_id
 * @property string|null $Faculty_id
 * @property string|null $Date
 * @property string|null $Percentage_time
 *
 * @package App\Models
 */
class DeptFac extends Model
{
	protected $table = 'Dept_Fac';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Dept_id',
		'Faculty_id',
		'Date',
		'Percentage_time'
	];
}
