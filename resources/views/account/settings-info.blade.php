@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account information</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-3">
                @include('account.partials.sidenav')
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Account information</div>
                    <div class="card-body">
                        <form action="{{ route('account.info.update') }}" method="POST">
                            @csrf                   {{-- Form field protection --}}
                            @form($currentUser)     {{-- Bind the authenticated user data to the form --}}
                            @method('PATCH')        {{-- HTTP method spoofing --}}

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label">Your name <span class="text-danger">*</span></label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control @error('firstname', 'is-invalid')" @input('firstname') placeholder="Your firstname">
                                    @error('firstname')
                                </div>

                                <div class="col-md-5">
                                    <input type="text" class="form-control @error('lastname', 'is-invalid')" @input('lastname') placeholder="Your lastname">
                                    @error('lastname')
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-3 col-form-label">Your username <span class="text-danger">*</span></label>


                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('name', 'is-invalid')" placeholder="Username" @input('name')>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-3 col-form-label">Your e-mail <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('email', 'is-invalid')" placeholder="Your email address" @input('email')>
                                    @error('email')
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row mb-0">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-outline-success">
                                        Save
                                    </button>

                                    <button type="reset" class="btn btn-outline-danger">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection