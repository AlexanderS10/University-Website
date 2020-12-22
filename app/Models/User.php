<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int|null $id_number
 * @property string|null $First_name
 * @property string|null $Last_name
 * @property Carbon|null $DOB
 * @property Carbon|null $Date_Created
 * @property string|null $Email
 * @property string|null $Password
 * @property string|null $Country
 * @property string|null $State
 * @property string|null $City
 * @property string|null $Street
 * @property string|null $Zipcode
 * @property string|null $User_Type
 *
 * @package App\Models
 */
class User extends Model
{
	protected $table = 'Users';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'id_number' => 'int'
	];

	protected $dates = [
		'DOB',
		'Date_Created'
	];

	protected $fillable = [
		'id_number',
		'First_name',
		'Last_name',
		'DOB',
		'Date_Created',
		'Email',
		'Password',
		'Country',
		'State',
		'City',
		'Street',
		'Zipcode',
		'User_Type'
	];
}
