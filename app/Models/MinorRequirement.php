<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MinorRequirement
 * 
 * @property string|null $Minor_id
 * @property string|null $Crs_id
 *
 * @package App\Models
 */
class MinorRequirement extends Model
{
	protected $table = 'Minor_Requirements';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Minor_id',
		'Crs_id'
	];
}
