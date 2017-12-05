<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;
use Carbon\Carbon;

class BonusWorkHours
{
//    public function build($rotaSlotStaffIds)
//    {
//        /** @var Collection $rotaSlotStaffCollection */
//        $rotaSlotStaffCollection = RotaSlotStaff::whereIn(
//            'id', $rotaSlotStaffIds
//        );

//        $dayNumbers = RotaSlotStaff::dayNumbers();

//        $rotaSlotStaffCollection = $rotaSlotStaffCollection->reject(
//            function (RotaSlotStaff $rotaSlotStaff) use ($rotaSlotStaffCollection) {
//                /** @var Carbon $startTime */
//                $startTime = $rotaSlotStaff->starTime;

//                return $rotaSlotStaffCollection->search(
//                    function (RotaSlotStaff $searchedItem) use ($startTime) {
//                        return $startTime->between(
//                            $searchedItem->startTime, $searchedItem->endTime
//                        );
//                    }
//                );
//            }
//        );
//
//        return $rotaSlotStaffCollection;
//    }

    public function handle()
    {
        $bonusTimes = [];
        $dayNumbers = RotaSlotStaff::dayNumbers();
        foreach ($dayNumbers as $dayNumber) {
            $bonusTimes[$dayNumber] = 0;
        }

        /** @var RotaSlotStaff $rotaSlotStaff */
        $rotaSlotStaff = RotaSlotStaff::get();

        foreach ($rotaSlotStaff as $shift) {
            /** @var Carbon $startTime */
            $startTime = $shift->startTime;
            /** @var Carbon $endTime */
            $endTime = $shift->endTime;

            $minutes = $endTime->diffInMinutes($startTime);

            $bonusTimes[$shift->daynumber] += $minutes;
        }

        return $bonusTimes;
    }
}