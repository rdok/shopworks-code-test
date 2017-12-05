<?php

namespace App\Http\Controllers;

use App\Acme\RotaSlotStaff\DailyWorkHours;
use App\Acme\RotaSlotStaff\StaffWithShifts;

class StaffShiftController extends Controller
{
    public function index(StaffWithShifts $staffWithShifts,
                          DailyWorkHours $workDays)
    {

        $staffWithShiftsBuilder = $staffWithShifts->build();

        $workDays = $workDays->build($staffWithShiftsBuilder->pluck('id'))
            ->get();

        $staffWithShifts = $staffWithShiftsBuilder->groupBy('staffid')
            ->paginate(10);

        return view('staff_shift.index', compact(
            'staffWithShifts', 'workDays'
        ));
    }
}
