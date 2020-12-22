<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hold
 * 
 * @property int|null $Hold_id
 * @property string|null $Hold_type
 *
 * @package App\Models
 */
class Hold extends Model
{
	protected $table = 'Hold';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Hold_id' => 'int'
	];

	protected $fillable = [
		'Hold_id',
		'Hold_type'
	];
}
