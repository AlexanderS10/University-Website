<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Faculty
 * 
 * @property string|null $Faculty_id
 * @property string|null $Room_id
 * @property string|null $Faculty_Speciality
 * @property int|null $Faculty_Rank
 * @property string|null $Faculty_Type
 * @property string|null $user_type
 *
 * @package App\Models
 */
class Faculty extends Model
{
	protected $table = 'Faculty';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Faculty_Rank' => 'int'
	];

	protected $fillable = [
		'Faculty_id',
		'Room_id',
		'Faculty_Speciality',
		'Faculty_Rank',
		'Faculty_Type',
		'user_type'
	];
}
