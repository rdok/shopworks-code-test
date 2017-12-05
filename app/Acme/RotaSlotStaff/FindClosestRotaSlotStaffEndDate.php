<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class FindClosestRotaSlotStaffEndDate
{
    public function handle(RotaSlotStaff $rotaSlotStaff,
                           Collection $rotaSlotStaffCollection)
    {
        foreach ($rotaSlotStaffCollection as $slot) {

            if ($slot->id == $rotaSlotStaff->id) {
                continue;
            }

            /** @var Carbon $endTime */
            $endTime = $rotaSlotStaff->endTime;

            $isBetween = $endTime->between($slot->startTime, $slot->endTime);

            if ($isBetween) {
                return $slot->startTime;
            }


//            if ($endTime->gt($slot->startTime)) {
//                return $slot->startTime;
//            }
        }

        return $rotaSlotStaff->endTime;
    }
}