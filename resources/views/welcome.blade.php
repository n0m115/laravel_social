@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">
        <div class="col-md-6">
            <h3>Sign Up</h3>
            <form action="{{ route('signup') }}" method="post">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email">Your E-Mail</label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="email" id="email_edit" value="{{ Request::old('email') }}" required="required">
                </div>
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    <label for="first_name">Your First Name</label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="first_name" id="first_name" value="{{ Request::old('first_name') }}" required="required">
                </div>
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    <label for="last_name">Your Last Name</label>
                    <input class="form-control" type="text" name="last_name" id="last_name" value="{{ Request::old('last_name') }}">
                </div>
                <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : '' }}">
                    <label for="date_of_birth">Your Date of Birth</label>
                    <div class="input-group datetimepicker">
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ Request::old('date_of_birth') }}">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password">Your Password</label>
                    <span class="required">*</span>
                    <input class="form-control" type="password" name="password" id="password_add" value="" required="required">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col-md-6">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="post">
                <div class="form-group {{ $errors->has('email_login') ? 'has-error' : '' }}">
                    <label for="email_login">Your E-Mail</label>
                    <span class="required">*</span>
                    <input class="form-control" type="text" name="email_login" id="email_login" value="{{ Request::old('email_login') }}" required="required">
                </div>
                <div class="form-group {{ $errors->has('password_login') ? 'has-error' : '' }}">
                    <label for="password_login">Your Password</label>
                    <span class="required">*</span>
                    <input class="form-control" type="password" name="password_login" id="password_login" value="" required="required">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
    </div>
@endsection