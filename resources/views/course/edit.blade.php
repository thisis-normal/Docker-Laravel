@if ($errors->any())
    <div class="alert alert-danger" style="color: red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('course.update', $course)}}" method="post">
    @csrf
    @method('PUT')
    <label>Name:<br>
        <input type="text" name="course_name" value="{{$course->course_name}}">
    </label>
    <br>
    <label><br>
        <button type="submit">
            Update
        </button>
    </label>
</form>
