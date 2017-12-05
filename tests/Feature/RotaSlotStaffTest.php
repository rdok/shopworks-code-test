<?php

namespace Tests\Feature;

use App\RotaSlotStaff;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RotaSlotStaffTest extends TestCase
{
    /** @test */
    public function knows_the_day_numbers_indexes()
    {
        $expectedIds = DB::table('rota_slot_staff')->groupBy('daynumber')
            ->pluck('daynumber');

        $this->assertEquals($expectedIds, RotaSlotStaff::dayNumbers());
    }
}
