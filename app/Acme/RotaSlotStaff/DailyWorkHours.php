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
    }
}