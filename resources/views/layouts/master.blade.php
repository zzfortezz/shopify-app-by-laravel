@extends('shopify-app::layouts.default')
@section('styles')

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700&amp;subset=vietnamese" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('libs/edite-table/jquery.edittable.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.scss') }}" type="text/css">
@endsection


@section('scripts')
@parent

<script type="text/javascript">
    // ESDK page and bar title
    window.mainPageTitle = 'Welcome Page';
    ShopifyApp.ready(function() {
        ShopifyApp.Bar.initialize({
            title: 'Edit Size Guide'
        })
    });
</script>
@endsection