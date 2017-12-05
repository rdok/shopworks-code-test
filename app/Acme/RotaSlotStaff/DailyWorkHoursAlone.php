<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DailyWorkHoursAlone
{
    public function build($rotaSlotStaffIds)
    {
        /** @var Collection $rotaSlotStaffCollection */
        $rotaSlotStaffCollection = RotaSlotStaff::whereIn(
            'id', $rotaSlotStaffIds
        );

        $dayNumbers = RotaSlotStaff::dayNumbers();

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

        return $rotaSlotStaffCollection;
    }
}