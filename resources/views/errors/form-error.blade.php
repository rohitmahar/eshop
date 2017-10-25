@if(count($errors))
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li type="none">{{ $error }}</li>
        @endforeach
    </ul>
@endif