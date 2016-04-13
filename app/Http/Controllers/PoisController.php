<?php
namespace App\Http\Controllers;

use App\Pois;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PoisController extends Controller
{
    public $viewDir = "pois";

    public function index()
    {
        $records = Pois::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    # 创建本地POI兴趣点
    public function create()
    {
        return $this->view("create");
    }

    # 保存本地POI逻辑
    public function store( Request $request )
    {
        $this->validate($request, Pois::validationRules());

        Pois::create($request->all());

        return redirect('/pois');
    }

    # 显示本地POI兴趣点信息
    public function show(Request $request, Pois $pois)
    {
        return $this->view("show",['pois' => $pois]);
    }

    # 编辑本地POI兴趣点
    public function edit(Request $request, Pois $pois)
    {
        return $this->view( "edit", ['pois' => $pois] );
    }

    # 更新本地POI兴趣点
    public function update(Request $request, Pois $pois)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Pois::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $pois->update($data);
            return "Record updated";
        }

        $this->validate($request, Pois::validationRules());

        $pois->update($request->all());

        return redirect('/pois');
    }

    #删除本地POI兴趣点
    public function destroy(Request $request, Pois $pois)
    {
        $pois->delete();
        return redirect('/pois');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
