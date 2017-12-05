<?php

namespace Tests\Feature;

use App\RotaSlotStaff;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RotaSlotStaffTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function knows_the_day_numbers_indexes()
    {
        $dataPath = base_path('tests/_data/staff_rota_shift_data.sql');
        DB::unprepared(file_get_contents($dataPath));

        $expectedIds = DB::table('rota_slot_staff')->groupBy('daynumber')
            ->pluck('daynumber');

        $this->assertEquals($expectedIds, RotaSlotStaff::dayNumbers());
    }
}
