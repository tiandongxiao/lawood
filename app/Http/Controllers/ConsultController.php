<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConsultController extends Controller
{
    # 律师所有私有咨询业务
    public function index()
    {
        return view('lawyer.consults');
    }

    # 创建新的咨询业务
    public function create()
    {
        return view('lawyer.consult_create');
    }

    # 保存逻辑
    public function store(Request $request)
    {
        //
    }

    # 显示一条consult详细信息
    public function show($id)
    {
        $consult = Item::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
