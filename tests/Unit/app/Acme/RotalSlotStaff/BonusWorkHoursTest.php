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

class BonusWorkHoursTest extends TestCase
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
    public function get_empty_bonus_shift_for_all_days_when()
    {
        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:00:00',
            'daynumber' => 0
        ]);
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:00:00',
            'daynumber' => 1
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([0 => 0, 1 => 0], $bonusTimes);
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
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([$dayNumber => 45], $bonusTimes);
    }

    /** @test */
    public function get_bonus_minutes_when_two_non_conflicting_shifts_exists_in_the_same_day()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:10:00',
            'daynumber' => $dayNumber = 2
        ]);

        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:15:00',
            'endtime' => '00:20:00',
            'daynumber' => $dayNumber
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([$dayNumber => 15], $bonusTimes);
    }

    /** @test */
    public function get_the_bonus_minutes_for_a_shift_being_covered_on_the_endtime()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:20:00',
            'daynumber' => $dayNumber = 2
        ]);

        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:15:00',
            'endtime' => '00:20:00',
            'daynumber' => $dayNumber
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([$dayNumber => 15], $bonusTimes);
    }

    /** @test */
    public function get_the_bonus_minutes_for_a_shift_being_covered_on_the_startime()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:20:00',
            'daynumber' => $dayNumber = 2
        ]);

        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:10:00',
            'daynumber' => $dayNumber
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([$dayNumber => 10], $bonusTimes);
    }

    /** @test */
    public function get_bonus_minutes_when_two_non_conflicting_shifts_exists_in_a_different_day()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:10:00',
            'daynumber' => $firstDayNumber = 0
        ]);

        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:15:00',
            'endtime' => '00:20:00',
            'daynumber' => $secondDayNumber = 1
        ]);

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([
            $firstDayNumber => 10,
            $secondDayNumber => 5,
        ], $bonusTimes);
    }

    /** @test */
    public function get_bonus_minutes_when_two_conflicting_shifts_exists_in_a_different_day()
    {
        // Given I have only one rota slot staff
        /** @var RotaSlotStaff $rotaSlotStaff */
        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:00:00',
            'endtime' => '00:15:00',
            'daynumber' => $firstDayNumber = 0
        ]);

        factory(RotaSlotStaff::class)->create([
            'starttime' => '00:10:00',
            'endtime' => '00:20:00',
            'daynumber' => $secondDayNumber = 1
        ]);

        $this->assertEquals(2, RotaSlotStaff::count());

        // Then the bonus working hours should equals to the duration of said
        // rotal slot staff
        $bonusTimes = $this->bonusWorkHours->handle(RotaSlotStaff::get());

        $this->assertEquals([
            $firstDayNumber => 15,
            $secondDayNumber => 10,
        ], $bonusTimes);
    }
}