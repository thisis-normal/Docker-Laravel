<form action="{{route('student.store')}}" method="post">
    @csrf
    <label>First name:<br>
        <input type="text" name="first_name" value="">
    </label>
    <br>
    <label>Last name:<br>
        <input type="text" name="last_name" value="">
    </label>
    <br>
    <label>Gender:<br>
        <input type="radio" name="gender" value="1">Male
        <input type="radio" name="gender" value="2">Female
    </label>
    <br>
    <label>Birthday:<br>
        <input type="date" name="birthday" value="">
    </label>
    <br>
    <label>Submit:<br>
        <input type="submit" name="submit" value="Submit">
    </label>
</form>
