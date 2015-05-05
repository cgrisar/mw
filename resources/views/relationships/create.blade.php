@extends('templates.1column')

@section('content')

    <h2 class="ui header">Create Relationship</h2>

    <h3 class="ui dividing header">Relationship information
        <div class="floatrighticon">
            <a href="{!! url('relationships/create') !!}" title="Save">
                <i class="black save circle icon"></i>
            </a>
            <a title="Cancel">
                <i class="red cancel circle icon"></i>
            </a>
        </div>
    </h3>

    {!! Form::open(['class' => 'ui form', 'url' => 'relationships/create']) !!}
        <div class="ui grid">
            <div class="row">
                <div class="eight wide column">

                    @include('partials.errors')


                    <div class="required field">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Name" name="name" value="{{old('name')}}" class="six wide column">
                    </div>

                    <div class="required field">
                        <label for="vat">VAT</label>
                        <input type="text" placeholder="VAT" name="vat" value="{{old('vat')}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="twelve wide column">
                    <div class="hidden divider"></div>
                    <h4 class="ui dividing header">Adresses
                        <div class="floatrighticon">
                            <i class="green plus icon" title="Create a new address"></i>
                        </div>
                    </h4>
                    <table id="adressesTable" class="ui sortable table verticalalign">
                        <thead>
                            <tr>
                                <th class="one wide">Type</th>
                                <th class="six wide">Address</th>
                                <th class="two wide">Phone</th>
                                <th class="two wide">Email</th>
                            </tr>
                        </thead>
                    </table>

                    {!! Form::submit('Save', ['class' => 'ui blue right floated button']) !!}

                </div>
            </div>
        </div>
    {!! Form::close() !!}

@endsection

@section('dTScript')
    <script>
        var sEditor;

        $(document).ready(function(){

            // create the Editor
            sEditor = new $.fn.dataTable.sEditor(
                    {   entity: 'relationship',
                        "fields" : [
                            { "structure" : "field",
                                "type" : "input",
                                "label": "name",
                                "field": "name"
                            },
                            { "structure": "multiple",
                                "field":
                                        [{  "structure": "field",
                                            "type": "input",
                                            "label": "zip",
                                            "name": "zip"
                                        }, {  "structure": "field",
                                            "type": "input",
                                            "label": "city",
                                            "name": "city"
                                        }]
                            },
                            { "structure": "field",
                                "type": "input",
                                "label": "country",
                                "name": "country"
                            }
                        ]
                    });
            // display the datatable


            $('#adressesTable').dataTable({

                "layout": '<div data-feature="dt_Table"></div>',

                "ajax": "/admin/relationshipTmpAddressesAjax",

                "columns": [
                    { "data": null,
                        "render": function(row, type, val, meta){
                            return "1"
                        }
                    },
                    { "data": null,
                        "render": function(row, type, val, meta){
                            return row.address + "</br>" + row.zip + "&nbsp;" + row.county + "</br>" + row.country
                        }},
                    { "data": "phone" },
                    { "data": "email" }
                ]
            });


            // Add a new address

            $('i.plus').on('click', function (e) {
                e.preventDefault();
                sEditor.show('create')
            } );

            $('#createAddressForm .field').change(function(){
                $(this).removeClass("error")
            });

            $('.ui.dropdown')
                    .dropdown();
        });
    </script>
@stop