@extends('templates.1column')

@section('content')

    <div class="sixteen wide column">

        <h2 class="ui header">Warehouses</h2>

        <h4 class="ui dividing header">List of warehouses</h4>

        @if($warehouses->isEmpty())
            <div class="ui primary inverted red segment">
                <p>No warehouse has been defined.</p>
            </div>
        @else
            <table class="ui table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Contact</td>
                        <td>Address</td>
                        <td>County</td>
                        <td>Country</td>
                        <td>Email</td>
                        <td>Telephone</td>
                        <td colspan="2" class="center aligned">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warehouses as $warehouse)
                        <tr>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->contact == '' ? '-' : $warehouse->contact }}</td>
                            <td>{{ $warehouse->address }}</td>
                            <td>{{ $warehouse->zip . " " . $warehouse->county }}</td>
                            <td>{{ $warehouse->country }}</td>
                            <td>{{ $warehouse->email }}</td>
                            <td>{{ $warehouse->tel }}</td>
                            <td class="center aligned"><a href="{{ url('warehouses/edit', $warehouse->id) }}" title="Edit"><i class="black edit icon"></i></a></td>
                            <td class="center aligned"><a href="{{ url('warehouses/delete', $warehouse->id) }}" title="Delete"><i class="black delete icon"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </br>
    </br>

    {!! link_to('warehouses/create', 'Create a Warehouse', ['class' => 'ui blue right button']) !!}

</div>

@stop