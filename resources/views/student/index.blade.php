@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Students') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary float-right mb-2" href="{{route('students.create')}}">Create Student</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>
                                    USN
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                <td>
                                    {{$student->usn}}
                                </td>

                                <td>
                                    {{$student->user->name}}
                                </td>
                                <td>
                                    {{$student->user->email}}
                                </td>
                                <td>
                                    <form action="{{route('students.destroy', ['student'=>$student->id])}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-primary mr-2"
                                            href="{{route('students.edit', ['student'=>$student->id])}}">Update</a>
                                        <button class="btn btn-danger mr-2" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection