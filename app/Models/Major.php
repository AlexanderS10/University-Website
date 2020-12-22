<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Major
 * 
 * @property int|null $Major_id
 * @property string|null $Major_name
 * @property string|null $Dept_id
 *
 * @package App\Models
 */
class Major extends Model
{
	protected $table = 'Major';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Major_id' => 'int'
	];

	protected $fillable = [
		'Major_id',
		'Major_name',
		'Dept_id'
	];
}
