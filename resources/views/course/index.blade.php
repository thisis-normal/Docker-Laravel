<a href="{{route('course.create')}}">
    Add New Course
</a>
<br>
<table border="1" width="100%">
    <tr>
        <th>
            #
        </th>
        <th>
            Name
        </th>
        <th>
            Created At
        </th>
        <th>
            DELETE
        </th>
    </tr>
    @foreach($courseList as $course)
        <tr>
            <td>
                {{ $course->id }}
            </td>
            <td>
                {{ $course->course_name }}
            </td>
            <td>
                {{ $course->created_at }}
            </td>
            <td>
                <form action="{{route('course.destroy', $course->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
