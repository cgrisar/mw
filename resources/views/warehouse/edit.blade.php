@extends('templates.2column-even')

@section('header')

    <h2 class="ui header">Edit Warehouse {{ $warehouse->name }}</h2>

@stop


@section('left-content')

    <h4 class="ui dividing header">Warehouse information
        <div class="floatrighticon">
            <i class="edit icon"></i>
            <i class="save icon"></i>
        </div>
    </h4>

    @include('partials.errors')

    <form method="POST" action="{{ action('WarehouseController@edit', $id) }}" class="ui small form">

        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        <div class="required field">
            <label for="name">Name</label>
            <input type="text" placeholder="Name" value="{{ $warehouse->name }}" name="name">
        </div>

        <div class="required field">
            <label for="excise">Excise Number</label>
            <input type="text" placeholder="Warehouse Excise Number" value="{{ $warehouse->excise    }}" name="excise">
        </div>

        <div class="ui divider"></div>

        <div class="field">
            <label for="contact">Contact</label>
            <input type="text" placeholder="Contact Person" value="{{ $warehouse->contact }}" name="contact">
        </div>

        <div class="required field">
            <label for="address">Address</label>
            <input type="text" placeholder="Address" value="{{ $warehouse->address }}" name="address">
        </div>

        <div class="fields">
            <div class="four wide required field">
                <label for="zip">Zip</label>
                <input type="text" placeholder="Zip" value="{{ $warehouse->zip }}" name="zip">
            </div>
            <div class="twelve wide required field">
                <label for="county">County</label>
                <input type="text" placeholder="County" value="{{ $warehouse->county }}" name="county">
            </div>
        </div>

        <div class="required field">
            <label for="country">Country</label>
            <input type="text" placeholder="Country" value="{{ $warehouse->country }}" name="country">
        </div>

        <div class="required field">
            <label for="email">E-mail</label>
            <input type="text" placeholder="E-mail address" value="{{ $warehouse->email }}" name="email">
        </div>

        <div class="required field">
            <label for="tel">Telephone</label>
            <input type="text" placeholder="Phone number" value="{{ $warehouse->tel }}" name="tel">
        </div>

        {!! Form::submit('Save Changes', ['class' => 'ui blue right floated button']) !!}

    </form>

@stop


@section('right-content')

    <h4 class="ui dividing header">Slots
        <div class="floatrighticon">
            <a class="item" id="Create">
                <i class="file outline icon"></i>
            </a>
        </div>
    </h4>

    @if($slots = $warehouse->slots->all())
        <table class="ui small basic table" id="slotsTable">
            <thead>
                <tr>
                    <td>Address</td>
                    <td>Excise</td>
                    <td>Capacity</td>
                    <td>In Slot</td>
                    <td colspan="2" class="center aligned">Actions</td>
                </tr>
            </thead>
            <tbody>
                @foreach($slots as $slot)
                    <tr>
                        <td>{{ $slot->address }}</td>
                        <td>
                            @if((boolean)$slot->excise)
                                <i class="checkmark icon"></i>
                            @else
                                <i class="minus icon"></i>
                            @endif
                        </td>
                        <td>{{ $slot->capacity }}</td>
                        <td></td>
                        <td class="center aligned"><i class="edit icon"</td>
                        <td class="center aligned" data-value="{{ $slot->id }}">
                            <a> <i class="delete icon"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @else
        <div class="ui inverted red segment" id="slotsMessage">
            <p>No slots have been defined for this warehouse</p>
        </div>
    @endif
@stop

@section('modals')
    @include('partials.Modals.slots.createslot')
    @include('partials.Modals.slots.deleteslot')
@stop


@section('extrajs')
    <script>
        @include('partials.Modals.slots.createslotjs')
        @include('partials.Modals.slots.deleteslotjs')
    </script>
@stop
