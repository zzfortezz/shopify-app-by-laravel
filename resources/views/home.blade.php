@extends('layouts.master')

@section('content')
    <p>You are: {{ ShopifyApp::shop()->shopify_domain }}</p>
    @php
    $shop = ShopifyApp::shop();
    $request = $shop->api()->rest('GET',"/admin/themes/36074160240/assets.json?asset[key]=templates/404.liquid");;
//    var_dump($request->body);
    @endphp
    <div class="container">
        <div class="row">
            <div class="section-header">
                <a href="{{ route('data.create') }}" class="btn btn-primary">Add Size</a>
            </div>
            <div class="table-responsive section-content">
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
                            <td><a href="{{ route('data.edit', ['id' => $size->id]) }}"><i class="far fa-edit"></i>Edit</a></td>
                            <td><a href="{{ route('data.delete', ['id' => $size->id]) }}" class="table-size-text"><i class="fa fa-trash"></i></a>Delete</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
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
                title: 'Size Guide'
            })


        });
    </script>
@endsection