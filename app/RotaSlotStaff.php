<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    protected $table = 'rota_slot_staff';
    protected $dates = [];

    public static function staffIds()
    {
        return RotaSlotStaff::shift()->staff()->select('staffid')
            ->groupBy('staffid');
    }

    /** Scope a query to only include rota slot staff with shift slot type.*/
    public function scopeShift(Builder $query)
    {
        return $query->where('slottype', 'shift');
    }

    /** Scope a query to only include rota slot staff with staff.*/
    public function scopeStaff(Builder $query)
    {
        return $query->whereNotNull('staffid')->orWhere('staffid', '!=', 0);
    }

    public function staff()
    {
        return $this->hasMany(RotaSlotStaff::class, 'staffid');
    }

    public function shifts()
    {
        return $this->hasMany(RotaSlotStaff::class, 'staffid', 'staffid');
    }

    public function getShiftAttribute()
    {
        $startTime = $this->starttime
            ? Carbon::createFromFormat('H:i:s', $this->starttime)->format('H:i')
            : null;

        $endTime = $this->endtime
            ? Carbon::createFromFormat('H:i:s', $this->endtime)->format('H:i')
            : null;

        return $startTime . ' - ' . $endTime;
    }

    public function getWorkHoursAttribute()
    {
        return number_format($this->toArray()['workHours'], 2);
    }
}
