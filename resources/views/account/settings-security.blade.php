@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Account security</li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-3">
                @include ('account.partials.sidenav')
            </div>

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Account security</div>
                    <div class="card-body">
                        <form action="{{ route('account.security.update') }}" method="POST">
                            @csrf               {{-- Form field protection --}}
                            @method('PATCH')    {{-- HTTP method spoofing --}}

                            <div class="form-group row">
                                <label for="password" class="col-md-3 col-form-label">Password <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <input type="password" class="form-control @error('password', 'is-invalid')" placeholder="Your new password" @input('password')>
                                    @error('password')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection