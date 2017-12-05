<?php

namespace App\Http\Controllers;

use App\Acme\RotaSlotStaff\DailyWorkHours;
use App\Acme\RotaSlotStaff\BonusWorkHours;
use App\Acme\RotaSlotStaff\StaffWithShifts;

class StaffShiftController extends Controller
{
    public function index(StaffWithShifts $staffWithShifts,
                          DailyWorkHours $workDays,
                          BonusWorkHours $dailyWorkHoursAlone)
    {
        $staffWithShiftsBuilder = $staffWithShifts->build();
        $rotaSlotStaffIds = $staffWithShiftsBuilder->pluck('id');

        $workDays = $workDays->build($rotaSlotStaffIds)->get();
        $workDaysAlone = $dailyWorkHoursAlone->build($rotaSlotStaffIds)->get();

        $staffWithShifts = $staffWithShiftsBuilder->groupBy('staffid')
            ->paginate(10);

        return view('staff_shift.index', compact(
            'staffWithShifts', 'workDays', 'workDaysAlone'
        ));
    }
}
