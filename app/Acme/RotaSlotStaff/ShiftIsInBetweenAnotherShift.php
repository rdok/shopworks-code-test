<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;
use Illuminate\Support\Collection;

class ShiftIsInBetweenAnotherShift
{
    public function handle(RotaSlotStaff $rotaSlotStaff,
                           Collection $rotaSlotStaffCollection)
    {
        foreach ($rotaSlotStaffCollection as $slot) {

            if ($slot->id == $rotaSlotStaff->id) {
                continue;
            }


            $startTimeIsBetween = $rotaSlotStaff->startTime
                ->between($slot->startTime, $slot->endTime);

            $endTimeIsBetween = $rotaSlotStaff->endTime
                ->between($slot->startTime, $slot->endTime);


            if ($startTimeIsBetween && $endTimeIsBetween) {

                return true;
            }
        }

        return false;
    }
}