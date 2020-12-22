<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeSlotDay
 * 
 * @property int|null $Timeslot_day_id
 * @property string|null $Day
 *
 * @package App\Models
 */
class TimeSlotDay extends Model
{
	protected $table = 'Time_Slot_Day';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Timeslot_day_id' => 'int'
	];

	protected $fillable = [
		'Timeslot_day_id',
		'Day'
	];
}
