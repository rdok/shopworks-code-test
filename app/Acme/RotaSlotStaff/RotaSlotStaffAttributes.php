<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;


use Carbon\Carbon;

trait RotaSlotStaffAttributes
{
    /** @return Carbon */
    public function getStartTimeAttribute()
    {
        $startTimeString = $this->getOriginal('starttime');

        return $startTimeString
            ? Carbon::createFromFormat('H:i:s', $startTimeString) : null;
    }

    /** @return Carbon */
    public function getEndTimeAttribute()
    {
        $endTimeString = $this->getOriginal('endtime');

        $endTime = $endTimeString
            ? Carbon::createFromFormat('H:i:s', $endTimeString) : null;

        if (empty($endTime)) {
            return $endTime;
        }

        if ($endTime->lessThan($this->startTime)) {
            $endTime->addDay();
        }

        return $endTime;
    }

    public function getShiftAttribute()
    {
        $startTime = $this->startTime ? $this->startTime->format('H:i') : null;

        $endTime = $this->endTime ? $this->endTime->format('H:i') : null;

        return $startTime . ' - ' . $endTime;
    }

    public function getWorkHoursAttribute()
    {
        return number_format($this->toArray()['workHours'], 2);
    }
}