<form action="{{route('course.store')}}" method="post">
    @csrf
    <label>Name:<br>
        <input type="text" name="course_name" value="">
    </label>
{{--    <br>--}}
{{--    <label>Last name:<br>--}}
{{--        <input type="text" name="last_name" value="">--}}
{{--    </label>--}}
{{--    <br>--}}
{{--    <label>Gender:<br>--}}
{{--        <input type="radio" name="gender" value="1">Male--}}
{{--        <input type="radio" name="gender" value="2">Female--}}
{{--    </label>--}}
{{--    <br>--}}
{{--    <label>Birthday:<br>--}}
{{--        <input type="date" name="birthday" value="">--}}
{{--    </label>--}}
    <br>
    <label><br>
        <input type="submit" name="submit" value="Submit">
    </label>
</form>
