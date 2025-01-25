<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Content;
use App\Models\PlayList;
use App\Models\TemplateList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\TemplateService;
use Illuminate\Support\Facades\Validator;

class TemplateListController extends Controller
{
    protected $templateService;
    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('template.show');
    }
    public function list()
    {
        return $this->templateService->list();
    }

    public function create(Request $request)
    {
        return $this->templateService->create($request);
    }

    public function edit($id)
    {
        return $this->templateService->edit($id);
    }

    public function update(Request $request)
    {
        return $this->templateService->update($request);
    }

    public function fullScreenTemplate()
    {
        return $this->templateService->fullScreenTemplate();
    }
    public function screenwise($param1, $param2, $param3, $param4)
    {
        return $this->templateService->getDataList($param1, $param2, $param3, $param4);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fullScreenTemplateEdit($id)
    {
        return $this->templateService->fullScreenTemplateEdit($id);
    }

    // public function create(Request $request)
    // {
    //     $audioLists = Content::where('content_type',  'Audio')->get();
    //     return view('template.create', compact('audioLists'));
    // }

    public function createList(Request $request)
    {
        return $this->templateService->getCreateList($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->templateService->getStore($request);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Request $request, String $id)
    // {
    //     return $this->templateService->getEdit($request, $id);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, String $id)
    // {
    //     return $this->templateService->getUpdate($request, $id);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->templateService->getDestroy($id);
    }
    public function get_playlist_type(Request $request)
    {
        return $this->templateService->get_playlist_type($request);
    }

    public function RSFTemplate()
    {
        return view('template.rsf');
    }

    public function item($id)
    {
        return $this->templateService->index($id);
    }
    public function assign_device(Request $request)
    {
        return $this->templateService->assign_device($request);
    }
    
}

