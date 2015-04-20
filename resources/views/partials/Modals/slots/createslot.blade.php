<div class="ui small modal" id="createModal" style="margin-top:-1px;">

    <i class="close icon"></i>

    <div class="header">
        Create slot for warehouse {{ $warehouse->name }}
    </div>

    <div class="content">
        <form method="POST" action="{{ action('SlotController@create', $warehouse->id) }}" class="ui small form" id="createSlotForm">

            <div class="four wide required field">
                <label for="address">Address</label>
                <input type="text" name="address" placeholder="address">
            </div>

            <div class="ui divider"></div>

            <div class="grouped fields">
                <label for="alone">Excise-slot</label>
                <div class="field">
                    <div class="ui radio checkbox checked">
                        <input type="radio" checked="" name="excise" value="1">
                        <label>Yes</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="excise" value="0">
                        <label>No</label>
                    </div>
                </div>
            </div>

            <div class="four wide required field">
                <label for="capacity">Capacity</label>
                <input type="text" name="capacity" placeholder="#bottles">
            </div>

            {!! Form::token() !!}
            {!! Form::submit('Save Changes', ['class' => 'ui positive button']) !!}

    </div>

</div>