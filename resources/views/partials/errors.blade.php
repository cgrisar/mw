@if($errors->any())
    <div class="ui small error message">

        <i class="close icon"></i>
        <div class = "ui tiny header">
            There was some error filing the registration form
        </div>

        <ul class="list">
            @foreach($errors->all() as $error)
                <li>{{ preg_replace('# field#', '', $error) }}</li>
            @endforeach
        </ul>
    </div>
@endif