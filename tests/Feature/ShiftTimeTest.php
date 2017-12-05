<?php

namespace Tests\Feature;

use App\RotaSlotStaff;
use Tests\TestCase;

class ShiftTimeTest extends TestCase
{
    /** @test */
    public function a_user_may_view_the_shift_time_index()
    {
        $rotaSlotStaff = RotaSlotStaff::shift()->first();

        $response = $this->get(route('shift_time.index'));

        $response->assertSee($rotaSlotStaff->starttime);

        $response->assertSee($rotaSlotStaff->endtime);

        $response->assertSee('id="' . $rotaSlotStaff->staffid);
    }
}
