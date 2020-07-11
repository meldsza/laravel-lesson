@extends('layouts.app')
@section('content')
<table class="table">
    <thead>
        <tr>
            <th>
                USN
            </th>

        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>
                {{$student->usn}}
            </td>


        </tr>
        @endforeach
    </tbody>
</table>
@endsection