@extends('shopify-app::layouts.default')
@section('styles')
    @parent
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.scss">
@endsection
@section('content')
    <p>You are: {{ ShopifyApp::shop()->shopify_domain }}</p>
    <div class="container">
        <div class="section-header">
            <a class="btn btn-primary">Add Size</a>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="section-summary">
                    <h2>Select Currencies</h2>
                    <p>Select the currencies that will appear in the Currency Switcher on your website.</p>
                </div>
            </div>
            <div class="col-md-8">
                <div class="section-content">
                    <form>
                        <div class="form-group">
                            <label for="title-table">Title</label>
                            <input type="text" class="form-control" id="title-table" placeholder="ex: T-shirt size">
                        </div>
                        <div class="form-group">
                            <label for="tab-description">Description</label>
                            <textarea class="form-control" id="tab-description" rows="4"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="libs/tinymce/js/tinymce/tinymce.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
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
                selector: '#tab-description'
            });

        });
    </script>
@endsection