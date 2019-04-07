@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Your Account</h3></header>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="first_name">First Name <span class="required">*</span></label>
                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name" required="required">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" id="last_name">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="text" name="password" class="form-control" value="" id="password">
                </div>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <div class="input-group datetimepicker">
                        <input type="text" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ ($user->date_of_birth != Config::get('constants.globals.default_timestamp')) ? date('d-m-Y h:i:s A', strtotime($user->date_of_birth)) : '' }}">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>

                @if (Storage::disk('local')->has($user->first_name . '-' . $user->id . '.jpg'))
                    <div class="form-group">
                        <a href="#" class="img-modal" data-modal-header-content="{{ '<b>' . $user->first_name . '</b> Profile Image' }}" data-modal-footer-content="">
                            <img src="{{ route('account.image', ['filename' => $user->first_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive profile-img-small">
                        </a>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
@endsection