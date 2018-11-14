@extends('layouts.master')
@section('styles')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container-fluid">
        @if ( count($errors) > 0 )
            @foreach( $errors->all() as $error )
                <div class="alert alert-warning">{{ $error }}</div>
            @endforeach
        @endif
        <form method="post" action="{{ route('data.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="section-summary">
                        <h2>Size Guide</h2>
                        <p>Select the currencies that will appear in the Currency Switcher on your website.</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="section-content">

                        <div class="form-group">
                            <label for="title-table">Title</label>
                            <input type="text" class="form-control" name="title" id="title-table" placeholder="ex: T-shirt size"  >
                        </div>
                        <div class="form-group">
                            <label for="table-size-description">Description</label>
                            <textarea class="form-control" id="table-size-description" name="description" rows="5"> </textarea>
                        </div>
                        <div class="form-group">
                            <label for="table-size">Description</label>
                            <textarea class="form-control" name="tabel_size" id="table-size" rows="3">
                                [["Size","Bust","Waist","Hips"],["8","32","25","35"],["10","34","27","37"],["12","36","29","39"]]
                            </textarea>
                        </div>

                    </div>
                </div>
                <div class="w-100 my-4 border-top"></div>
                <div class="col-md-4">
                    <div class="section-summary">
                        <h2>Size guide settings</h2>
                        <p>Select the currencies that will appear in the Currency Switcher on your website.</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="section-content">
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 pt-0"> Collection
                                    <small id="emailHelp" class="form-text text-muted">Select collection this size guide will show.</small>
                                </legend>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="custom-control condition-wrapper">
                                                <select name="condition" class="selection-js w-100">
                                                    <option>Select an option</option>
                                                    <option value="product">Products</option>
                                                    <option value="collection">Collections</option>
                                                    <option value="tag">Tags</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="custom-control value-condition-wrapper">
                                                <select class="value-condition selection-js  w-100" multiple="multiple">
                                                    <option>Select option</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-100"></div>
                                <legend class="col-form-label col-sm-3 pt-0"> Text:
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </legend>
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <input type="text" id="" name="text-display" class="form-control" autocomplete="false">
                                    </div>
                                </div>

                                <legend class="col-form-label col-sm-3 pt-0"> Open guide with:
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </legend>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Link</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio2">Button</label>
                                    </div>
                                </div>

                                <legend class="col-form-label col-sm-3 pt-0"> Position display
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </legend>
                                <div class="col-sm-9">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1">Link</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="fixed-bottom section-footer">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script type="text/javascript">
        // ESDK page and bar title
        window.mainPageTitle = 'Welcome Page';
        ShopifyApp.ready(function() {
            ShopifyApp.Bar.initialize({
                title: 'Edit Size Guide'
            });
            tinymce.init({
                selector: '#table-size-description',
                plugins: 'image',
                branding: false // To disable "Powered by TinyMCE" branding: false // To disable "Powered by TinyMCE"
            });

            // mytable.loadData(dataArray);

            var mytable = $('#table-size').editTable({
                data: [['']],           // Fill the table with a js array (this is overridden by the textarea content if not empty)
                tableClass: 'inputtable',   // Table class, for styling
                jsonData: false,        // Fill the table with json data (this will override data property)
                headerCols: false,      // Fix columns number and names (array of column names)
                maxRows: 99,           // Max number of rows which can be added
                first_row: true,        // First row should be highlighted?
                row_template: false,    // An array of column types set in field_templates
                field_templates: false, // An array of custom field type objects

            });

        });
        $('.selection-js').select2({
            selectOnClose: true,
            allowClear: true
        });

        selection_condition();

        function selection_condition(){
            $('.condition-wrapper .selection-js').on('change',function (){
                var value = $(this).val();
                $.ajax({
                    type: 'GET',
                    data:{
                        condition: value
                    },
                    url: './get/condition',
                    success: function (resp){
                        if( resp.status ){
                            console.log(resp)
                        }
                    },
                    error: function (resp) {
                        console.log('get data error');
                    }
                })
            })
        }
    </script>
@endsection