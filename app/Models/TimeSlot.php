<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeSlot
 * 
 * @property int|null $Timeslot_id
 * @property string|null $Timeslot_day_id
 * @property string|null $Timeslot_period_id
 *
 * @package App\Models
 */
class TimeSlot extends Model
{
	protected $table = 'Time_Slot';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Timeslot_id' => 'int'
	];

	protected $fillable = [
		'Timeslot_id',
		'Timeslot_day_id',
		'Timeslot_period_id'
	];
}
