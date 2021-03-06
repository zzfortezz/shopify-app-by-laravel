@extends('layouts.master')

@section('content')
    <a href="/shopify-app-by-laravel/edit">click</a>
    <p>You are: {{ ShopifyApp::shop()->shopify_domain }}</p>
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
                            <input type="text" class="form-control" name="title" id="title-table" placeholder="ex: T-shirt size" value="{{ $sizeguides->title  ?? '' }}" >
                        </div>
                        <div class="form-group">
                            <label for="table-size-description">Description</label>
                            <textarea class="form-control" id="table-size-description" name="description" rows="5"> {{ $sizeguides->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="table-size">Description</label>
                            <textarea class="form-control" name="tabel_size" id="table-size" rows="3">
                                @if ( $sizeguides->sizes != '' )
                                    {{ $sizeguides->sizes }}
                                @else
                                    [["Size","Bust","Waist","Hips"],["8","32","25","35"],["10","34","27","37"],["12","36","29","39"]]
                                @endif
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
    </script>
@endsection