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
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
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
                            <th>Work Duration - Alone</th>
                            @foreach($workDays as $day)
                                <th>{{ $day->workHours }}</th>
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
