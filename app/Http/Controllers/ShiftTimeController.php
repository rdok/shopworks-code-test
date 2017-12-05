<?php

namespace App\Http\Controllers;

use App\RotaSlotStaff;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShiftTimeController extends Controller
{
    public function index()
    {
        $rotaSlotStaff = RotaSlotStaff::shift()->staff()
            ->with(['shifts' => function (HasMany $hasMany) {
                $hasMany->orderBy('daynumber', 'asc');
            }])
            ->groupBy('staffid')
            ->paginate(10);

        return view('shift_time.index', compact('rotaSlotStaff'));
    }
}
