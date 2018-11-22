@if(count($errors))
    <div class="alert alert-danger">
        <ul>
            <div class="xuan" role="alert">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </div>
        </ul>
    </div>
@endif