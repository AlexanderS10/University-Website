<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Admin
 * 
 * @property string|null $Admin_id
 * @property string|null $Priviledge_Level
 *
 * @package App\Models
 */
class Admin extends Model
{
	protected $table = 'Admin';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Admin_id',
		'Priviledge_Level'
	];
}
