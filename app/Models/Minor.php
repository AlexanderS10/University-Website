<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Minor
 * 
 * @property int|null $Minor_id
 * @property string|null $Minor_name
 * @property string|null $Dept_id
 *
 * @package App\Models
 */
class Minor extends Model
{
	protected $table = 'Minor';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Minor_id' => 'int'
	];

	protected $fillable = [
		'Minor_id',
		'Minor_name',
		'Dept_id'
	];
}
