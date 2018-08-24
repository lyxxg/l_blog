@if(count($errors)>0)
@foreach($errors->all() as $error)

    <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert">
            &times;
        </a>
        <strong>{{ $error }} !</strong>
    </div>

@endforeach

@endif
