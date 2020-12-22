<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TimeSlotPeriod
 * 
 * @property int|null $Timeslot_period_id
 * @property string|null $Period
 *
 * @package App\Models
 */
class TimeSlotPeriod extends Model
{
	protected $table = 'Time_Slot_Period';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'Timeslot_period_id' => 'int'
	];

	protected $fillable = [
		'Timeslot_period_id',
		'Period'
	];
}
