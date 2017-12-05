<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BonusWorkHours
{
    /** @var FindClosestRotaSlotStaffEndDate */
    private $findClosestRotaSlotStaffEndDate;
    /** @var FindClosestRotaSlotStaffStartDate */
    private $findClosestRotaSlotStaffStartDate;
    /** @var ShiftIsInBetweenAnotherShift */
    private $shiftIsInBetweenAnotherShift;

    public function __construct(
        ShiftIsInBetweenAnotherShift $shiftIsInBetweenAnotherShift,
        FindClosestRotaSlotStaffEndDate $findClosestRotaSlotStaffEndDate,
        FindClosestRotaSlotStaffStartDate $findClosestRotaSlotStaffStartDate)
    {
        $this->findClosestRotaSlotStaffEndDate = $findClosestRotaSlotStaffEndDate;
        $this->findClosestRotaSlotStaffStartDate = $findClosestRotaSlotStaffStartDate;
        $this->shiftIsInBetweenAnotherShift = $shiftIsInBetweenAnotherShift;
    }

    public function handle(Collection $rotaSlotStaffCollection)
    {
        $bonusTimes = [];
        $dayNumbers = RotaSlotStaff::dayNumbers();
        foreach ($dayNumbers as $dayNumber) {
            $bonusTimes[$dayNumber] = 0;
        }

        foreach ($rotaSlotStaffCollection as $key => $shift) {

            if ($this->shiftIsInBetweenAnotherShift
                ->handle($shift, $rotaSlotStaffCollection)) {
                continue;
            }

            /** @var Carbon $startTime */
            $startTime = $this->findClosestRotaSlotStaffStartDate
                ->handle($shift, $rotaSlotStaffCollection);

            /** @var Carbon $endTime */
            $endTime = $this->findClosestRotaSlotStaffEndDate
                ->handle($shift, $rotaSlotStaffCollection);

            $minutes = $endTime->diffInMinutes($startTime);

            $bonusTimes[$shift->daynumber] += $minutes;
        }

        return $bonusTimes;
    }
}