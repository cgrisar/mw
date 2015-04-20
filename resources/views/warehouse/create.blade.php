@extends('templates.1column')

@section('content')

    <h2 class="ui header">Create Warehouse</h2>

    <h4 class="ui dividing header">Warehouse information</h4>

    <div class="eight wide column">

        @include('partials.errors')

        {!! Form::open(['class' => 'ui small form', 'url' => 'warehouses/create']) !!}

            <div class="required field">
                <label for="name">Name</label>
                <input type="text" placeholder="Name" name="name" value="{{old('name')}}">
            </div>

            <div class="required field">
                <label for="excise">Excise Number</label>
                <input type="text" placeholder="Warehouse Excise Number" name="excise" value="{{old('excise')}}">
            </div>

            <div class="ui divider"></div>

            <div class="field">
                <label for="contact">Contact</label>
                <input type="text" placeholder="Contact Person" name="contact" value="{{old('contact')}}">
            </div>

            <div class="required field">
                <label for="address">Address</label>
                <input type="text" placeholder="Address" name="address" value="{{old('address')}}">
            </div>

            <div class="fields">
                <div class="four wide required field">
                    <label for="zip">Zip</label>
                    <input type="text" placeholder="Zip" name="zip" value="{{old('zip')}}">
                </div>
                <div class="twelve wide required field">
                    <label for="county">County</label>
                    <input type="text" placeholder="County" name="county" value="{{old('county')}}">
                </div>
            </div>

            <div class="required field">
                <label for="country">Country</label>
                <input type="text" placeholder="Country" name="country" value="{{old('country')}}">
            </div>

            <div class="required field">
                <label for="email">E-mail</label>
                <input type="text" placeholder="E-mail address" name="email" value="{{old('email')}}">
            </div>

            <div class="required field">
                <label for="tel">Telephone</label>
                <input type="text" placeholder="Phone number" name="tel" value="{{old('tel')}}">
            </div>


        {!! Form::submit('Save', ['class' => 'ui blue right floated button']) !!}

        {!! Form::close() !!}

    </div>
@endsection