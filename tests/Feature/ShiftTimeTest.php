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

        $response = $this->get(route('staff_shift.index'));

        $response->assertSee($rotaSlotStaff->shift);

        $response->assertSee('id="' . $rotaSlotStaff->staffid);
    }
}
