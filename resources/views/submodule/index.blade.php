@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Modules') }}</div>

                <div class="card-body">
                    <a class="btn btn-primary float-right mb-2"
                        href="{{route('modules.subModules.create', ['module'=> $module->id])}}">Create Module</a>

                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    Name
                                </th>

                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subModules as $subModule)
                            <tr>

                                <td>
                                    {{$subModule->name}}
                                </td>

                                <td>
                                    <form
                                        action="{{route('modules.subModules.destroy', ['module'=> $module->id,'subModule'=>$subModule->id])}}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <a class="btn btn-primary mr-2"
                                            href="{{route('modules.subModules.show', ['module'=> $module->id,'subModule'=>$subModule->id])}}">View</a>
                                        <a class="btn btn-primary mr-2"
                                            href="{{route('modules.subModules.edit', ['module'=> $module->id,'subModule'=>$subModule->id])}}">Update</a>
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