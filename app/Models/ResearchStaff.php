<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ResearchStaff
 * 
 * @property string|null $Researcher_id
 * @property string|null $Priviledge_Level
 *
 * @package App\Models
 */
class ResearchStaff extends Model
{
	protected $table = 'Research_Staff';
	public $incrementing = false;
	public $timestamps = false;

	protected $fillable = [
		'Researcher_id',
		'Priviledge_Level'
	];
}
