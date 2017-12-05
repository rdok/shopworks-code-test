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

                        <?php /** @var \App\RotaSlotStaff $slotStaff */?>
                        <?php /** @var \Illuminate\Pagination\LengthAwarePaginator $rotaSlotStaff */?>
                        @foreach($rotaSlotStaff as $slotStaff)
                            <tr>
                                <td id="{!! $slotStaff->staffid !!}">
                                    {{ $slotStaff->staffid }}
                                </td>
                                @foreach($slotStaff->shifts as $shift)
                                    <td>{{ $shift->shift }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                {{ $rotaSlotStaff->links() }}
            </div>
        </div>
    </div>
@endsection
