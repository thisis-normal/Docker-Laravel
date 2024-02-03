@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li style="color: red">{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{route('course.store')}}" method="post">
    @csrf
    <label>Name:<br>
        <input type="text" name="course_name" value="{{old('course_name')}}">
    </label>
    @if($errors->has('course_name'))
        <br>
        <span style="color: red">{{$errors->first('course_name')}}</span>
    @endif
    <br>
    <label><br>
        <input type="submit" name="submit" value="Submit">
    </label>
</form>
