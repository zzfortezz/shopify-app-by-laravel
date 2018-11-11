@extends('layouts.master')

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
                                <td><a href=""><i class="far fa-edit"></i></a>Edit</td>
                                <td><a href="" class="table-size-text"><i class="fa fa-trash"></i></a>Delete</td>
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
    <script type="text/javascript">
        // ESDK page and bar title
        window.mainPageTitle = 'Welcome Page';
        ShopifyApp.ready(function() {
            ShopifyApp.Bar.initialize({
                title: 'Welcome'
            })


        });
    </script>
@endsection