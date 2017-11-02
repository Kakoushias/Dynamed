<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condition extends Model
{
	protected $fillable = ['name'];

	public function patients(){

		return $this->belongsToMany(Patient::class, 'condition_patient', 'condition_id', 'patient_id');
	}
    //
}
