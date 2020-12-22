<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MajorRequirement
 * 
 * @property string|null $Major_id
 * @property string|null $Crs_id
 *
 * @package App\Models
 */
class MajorRequirement extends Model
{
	protected $table = 'Major_Requirements';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Major_id',
		'Crs_id'
	];
}
