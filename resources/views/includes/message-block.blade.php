@if(count($errors) > 0)
    <div class="row marg-bot-15">
        <div class="col-md-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="alert alert-danger my-alert">{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="row marg-bot-15">
        <div class="col-md-4">
            <ul>
                <li class="alert alert-danger my-alert">{{Session::get('message')}}</li>
            </ul>
        </div>
    </div>
@endif