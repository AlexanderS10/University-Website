<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Prerequisite
 * 
 * @property int|null $Prereq_id
 * @property string|null $Crs_id
 *
 * @package App\Models
 */
class Prerequisite extends Model
{
	protected $table = 'Prerequisite';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Prereq_id' => 'int'
	];

	protected $fillable = [
		'Prereq_id',
		'Crs_id'
	];
}
