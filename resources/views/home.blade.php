@extends('shopify-app::layouts.default')
@section('styles')
    @parent
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="libs/edite-table/jquery.edittable.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.scss">
@endsection
@section('content')
    <a href="/shopify-app-by-laravel/edit">click</a>
    <p>You are: {{ ShopifyApp::shop()->shopify_domain }}</p>
    <div class="container-fluid">
        <div class="section-header">
            <a class="btn btn-primary">Add Size</a>
        </div>
        <div class="container">
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $sizeguieds as $k => $size)
                            <tr>
                                <th scope="row">{{ $k }}</th>
                                <td>{{ $size->title }}</td>
                                <td><a href=""><i class="fa fa-pencil"></i></a>  </td>
                                <td><a href=""><i class="fa fa-trash"></i></a> </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @parent
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="libs/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="libs/edite-table/jquery.edittable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // ESDK page and bar title
        window.mainPageTitle = 'Welcome Page';
        ShopifyApp.ready(function() {
            ShopifyApp.Bar.initialize({
                title: 'Welcome'
            })
            tinymce.init({
                selector: '#table-size-description',
                plugins: 'image',
                branding: false // To disable "Powered by TinyMCE" branding: false // To disable "Powered by TinyMCE"
            });

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