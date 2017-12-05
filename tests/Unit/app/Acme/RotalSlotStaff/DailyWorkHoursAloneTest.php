<?php
/**
 * @author Rizart Dokollari <r.dokollari@gmail.com>
 * @since 12/5/17
 */

namespace tests\Unit\app\Acme\RotalSlotStaff;

use App\Acme\RotaSlotStaff\BonusWorkHours;
use App\RotaSlotStaff;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DailyWorkHoursAloneTest extends TestCase
{
    use DatabaseMigrations;

    /** @var  BonusWorkHours */
    protected $bonusWorkHours;

    public function setUp()
    {
        parent::setUp();

        $this->bonusWorkHours = app()->make(BonusWorkHours::class);
    }

    /** @test */
    public function get_bonus_minutes_when_only_a_single_shift_exists_in_a_day()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:45:00',
            'daynumber' => $dayNumber = 2
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle();

        $this->assertEquals([$dayNumber => 45], $bonusTimes);
    }
}