<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lab
 * 
 * @property string|null $Room_id
 * @property string|null $Capacity
 * @property string|null $Total_Seats
 *
 * @package App\Models
 */
class Lab extends Model
{
	protected $table = 'Lab';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Room_id',
		'Capacity',
		'Total_Seats'
	];
}
