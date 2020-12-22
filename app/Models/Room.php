<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Room
 * 
 * @property int|null $Room_id
 * @property string|null $Building_id
 * @property string|null $Room_Type
 *
 * @package App\Models
 */
class Room extends Model
{
	protected $table = 'Room';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Room_id' => 'int'
	];

	protected $fillable = [
		'Room_id',
		'Building_id',
		'Room_Type'
	];
}
