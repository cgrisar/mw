@extends('templates.1column')

@section('content')

    <div class="sixteen wide column">

        <h2 class="ui header">Relationships</h2>

        <h4 class="ui dividing header">List of relationships
            <div class="floatrighticon">
                <a href="{!! url('relationships/create') !!}" title="Create a new relationship">
                   <i class="green add circle icon"></i>
                </a>
            </div>
        </h4>

        @if($relationships->isEmpty())
            <div class="ui primary inverted red segment">
                <p>No relationship has been defined.</p>
            </div>
        @else
            <table id="relationshipTable" class="ui sortable table">
                <thead>
                    <tr>
                        <th class="eight wide">Name</th>
                        <th class="six wide">VAT</th>
                        <th class="center aligned">Actions</th>
                    </tr>
                </thead>
            </table>
            @endif
    </div>

@stop


@section('dTScript')
    <script>
        var editor ;

        $(document).ready(function(){

            $('#relationshipTable').dataTable({

                "ajax": "admin/relationshipsajax",

                "columns": [
                    { "data": "name" },
                    { "data": "vat" },
                    { "data": null,
                      "orderable": false,
                      "className": "center aligned",
                      "defaultContent": "<i class='edit icon'></i> <i class='delete icon'></i></td>" }
                ]
            });

            $('.ui.dropdown')
                    .dropdown();
        });
    </script>
@stop