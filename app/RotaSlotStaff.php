<?php

namespace App;

use App\Acme\RotaSlotStaff\RotaSlotStaffAttributes as Attributes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RotaSlotStaff extends Model
{
    use Attributes;

    protected $table = 'rota_slot_staff';
    protected $fillable = ['starttime', 'endtime'];

    public static function staffIds()
    {
        return RotaSlotStaff::shift()->staff()->select('staffid')
            ->groupBy('staffid');
    }
    public static function dayNumbers()
    {
        return RotaSlotStaff::groupBy('daynumber')->pluck('daynumber');
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
}
