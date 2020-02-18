
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(Session::has('message'))
                <?php echo "hi"; ?>
                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                        <br>
                            Add Customer Here!

                            <form action="/postCustomer" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="title">Name</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="address">Address</label>
                                    <div class="col-md-6">
                                        <textarea cols="30" class="form-control" rows="4" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="mobiltno">Mobile no</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" name="mobileno">
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <input type="submit" name="submit">
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
