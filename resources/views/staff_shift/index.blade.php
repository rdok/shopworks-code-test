@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Shift Times</div>

                    <table class="table">

                        <thead>
                        <tr>
                            <th>Staff ID</th>
                            <th>Day 0</th>
                            <th>Day 1</th>
                            <th>Day 2</th>
                            <th>Day 3</th>
                            <th>Day 4</th>
                            <th>Day 5</th>
                            <th>Day 6</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <th>Work Duration</th>
                            @foreach($workDays as $day)
                                <th>{{ $day->workHours }}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Work Duration - Bonus Minutes</th>
                            @foreach($bonusWorkDays as $minutes)
                                <th>{{ $minutes }}</th>
                            @endforeach
                        </tr>
                        </tfoot>

                        <?php /** @var \App\RotaSlotStaff $staff */?>
                        <?php /** @var \Illuminate\Pagination\LengthAwarePaginator $staffWithShifts */?>
                        @foreach($staffWithShifts as $staff)
                            <tr>
                                <td id="{!! $staff->staffid !!}">
                                    {{ $staff->staffid }}
                                </td>
                                @foreach($staff->shifts as $shift)
                                    <td>{{ $shift->shift }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $staffWithShifts->links() }}
            </div>
        </div>
    </div>
@endsection
