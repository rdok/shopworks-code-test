<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;

use App\RotaSlotStaff;

class DailyWorkHours
{
    public function build($rotaSlotStaffIds)
    {
        return RotaSlotStaff::whereIn('id', $rotaSlotStaffIds)
            ->selectRaw('daynumber, sum(workhours) as workHours')
            ->groupBy('daynumber');

//        dd(
//            RotaSlotStaff::
//                ->selectRaw('daynumber, time(sum(TIMEDIFF( starttime, endtime ))) as total')
//                selectRaw("daynumber, time(sum(timediff(starttime, endtime))) as result")
//                selectRaw('daynumber, sec_to_time(abs(sum(time_to_sec(starttime) - time_to_sec(endtime)))) as total')
//                ->groupBy('daynumber')
//            ->toSql()
//                ->first()->toArray()
//        );
    }
}