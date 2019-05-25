<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $guarded =[];

    public function patient()
    {
        return $this->belongsTo('App\Patient','patient_id');
    }

    public function medicalPractitioner()
    {
        return $this->belongsTo('App\User','seen_by');
    }

    public function receiptionist()
    {
        return $this->belongsTo('App\User', 'checked_in_by');
    }
}
