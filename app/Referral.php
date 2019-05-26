<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $guarded =[];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function referredBy()
    {
        return $this->belongsTo('App\User','referred_by');
    }

    public function seenBy()
    {
        return $this->belongsTo('App\User','seen_by');
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
