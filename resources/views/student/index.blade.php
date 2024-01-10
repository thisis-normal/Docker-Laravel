<h1>
    This is student index page
</h1>
<a href="{{ route('student.create') }}">
    Create new student
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
            Age
        </th>
        <th>
            Gender
        </th>
    </tr>
    <@foreach($studentList as $student)
        <tr>
            <td>
                {{ $student->id }}
            </td>
            <td>
                {{ $student->full_name }}
            </td>
            <td>
                {{ $student->age }}
            </td>
            <td>
                {{ $student->gender }}
            </td>
    @endforeach
</table>
