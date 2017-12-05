<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace App\Acme\RotaSlotStaff;


use App\RotaSlotStaff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StaffWithShifts
{
    /** @return Builder */
    public function build()
    {
        return RotaSlotStaff::shift()->staff()->with([
            'shifts' => function (HasMany $hasMany) {
                $hasMany->orderBy('daynumber', 'asc');
            }
        ]);
    }
}