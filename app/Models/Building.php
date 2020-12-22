<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Building
 * 
 * @property int|null $Building_id
 * @property string|null $Building_name
 * @property string|null $Building_Type
 *
 * @package App\Models
 */
class Building extends Model
{
	protected $table = 'Building';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Building_id' => 'int'
	];

	protected $fillable = [
		'Building_id',
		'Building_name',
		'Building_Type'
	];
}
