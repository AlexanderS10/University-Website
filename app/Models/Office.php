<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Office
 * 
 * @property string|null $Room_id
 * @property string|null $Total_Seats
 * @property string|null $Capacity
 *
 * @package App\Models
 */
class Office extends Model
{
	protected $table = 'Office';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Room_id',
		'Total_Seats',
		'Capacity'
	];
}
