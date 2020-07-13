<?php

namespace App\Http\Controllers;

use App\SubModule;
use App\Module;
use Illuminate\Http\Request;

class SubModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Module $module)
    {
        return view('submodule.index', ['module'=> $module, 'subModules'=> $module->submodules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Module $module)
    {
        return view('submodule.create', ['module'=> $module]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Module $module)
    {
        return abort(404);
        $data = $request->validate([
            'name' => 'string|required',
        ]);
        $subModule = new SubModule();
        $subModule->fill($data);
        $subModule->module_id = $module->id;
        $subModule->content_type="";
        $subModule->content_id=0;
        $subModule->save();
        //$subModule->module()->associate($module)->save();
        return redirect(route('modules.subModules.index', ['module'=> $module->id]));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeVideo(Request $request, Module $module)
    {
        return abort(404);
        $data = $request->validate([
            'name' => 'string|required',
            'file' => 'file|required'
        ]);
        $data['path'] = $request->file('file')->store();
        DB::transaction(function() use($data){
            $video = new Video();
            $video->fill($data);
            $subModule = new SubModule();
            $subModule->fill($data);
            $subModule->module_id = $module->id;
            $subModule->content()->associate($video)->save();
        });
        
       
        //$subModule->module()->associate($module)->save();
        return redirect(route('modules.subModules.index', ['module'=> $module->id]));
    }
    public function createVideo(Module $module){
        return view('submodule.createVideo', ['module'=>$module]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubModule  $subModule
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module, SubModule $subModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubModule  $subModule
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module, SubModule $subModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubModule  $subModule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module, SubModule $subModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubModule  $subModule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module, SubModule $subModule)
    {
        //
    }
}
