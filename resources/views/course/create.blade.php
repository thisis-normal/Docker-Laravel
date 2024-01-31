{{--@if ($errors->any())--}}
{{--    <div class="alert alert-danger" style="color: red">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
<form action="{{route('course.store')}}" method="post">
    @csrf
    <label>Name:<br>
        <input type="text" name="course_name" value="{{old('course_name')}}">
    </label>
    <br>
    @if($errors->has('course_name'))
        <span style="color: red">{{$errors->first('course_name')}}</span>
    @endif
    <br>
    <label><br>
        <input type="submit" name="submit" value="Submit">
    </label>
</form>
{{--<script>--}}
{{--    alert("hi");--}}
{{--</script>--}}
