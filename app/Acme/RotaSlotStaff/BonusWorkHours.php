<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

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
        return [2 => 45];
    }
}