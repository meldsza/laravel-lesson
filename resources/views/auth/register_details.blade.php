@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Choose Account Type') }}</div>

                <div class="card-body">
                    <div class="button-group">
                        <button class="btn btn-large" onclick="displayStudentForm">Student</button>
                        <button class="btn btn-large" onclick="displayFacultyForm">Faculty</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" id="facultyForm">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.details.faculty') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="employee_code"
                                class="col-md-4 col-form-label text-md-right">{{ __('Employee Code') }}</label>

                            <div class="col-md-6">
                                <input id="employee_code" type="text"
                                    class="form-control @error('employee_code') is-invalid @enderror"
                                    name="employee_code" value="{{ old('employee_code') }}" required
                                    autocomplete="employee_code" autofocus>

                                @error('employee_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="designation"
                                class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text"
                                    class="form-control @error('designation') is-invalid @enderror" name="designation"
                                    value="{{ old('designation') }}" required autocomplete="designation" autofocus>

                                @error('designation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center" id="studentForm">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login.details.student') }}">
                        @csrf
                        <div class="form-group row">

                            <label for="usn" class="col-md-4 col-form-label text-md-right">{{ __('USN') }}</label>

                            <div class="col-md-6">
                                <input id="usn" type="text" class="form-control @error('usn') is-invalid @enderror"
                                    name="usn" value="{{ old('usn') }}" required autocomplete="usn" autofocus>

                                @error('usn')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#studentForm').hide();
    $('#facultyForm').hide();
    function displayStudentForm(){
        $('#studentForm').show();
        $('#facultyForm').hide();
    }
    function displayFacultyForm(){
        $('#studentForm').hide();
        $('#facultyForm').show();
        
    }
</script>
@endsection