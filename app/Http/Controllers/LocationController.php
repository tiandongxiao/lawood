<?php
namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public $viewDir = "location";

    public function index()
    {
        $records = Location::findRequested();
        return $this->view( "index", ['records' => $records] );
    }

    # 创建一个新的执业地址
    public function create()
    {
        return $this->view("create");
    }

    # 地址保存逻辑
    public function store( Request $request )
    {
        $this->validate($request, Location::validationRules());

        $location = Location::create($request->all());

        #绑定地址给当前用户，地址为专属地址，不共享，哪怕地址相同
        if($location){
            Auth::user()->locations()->save($location);
        }

        return redirect('/location');
    }

    # 显示一个地址的详细信息
    public function show(Request $request, Location $location)
    {
        return $this->view("show",['location' => $location]);
    }

    # 编辑一个地址信息
    public function edit(Request $request, Location $location)
    {
        return $this->view( "edit", ['location' => $location] );
    }

    # 更新地址信息的逻辑
    public function update(Request $request, Location $location)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Location::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $location->update($data);
            return "Record updated";
        }

        $this->validate($request, Location::validationRules());

        $location->update($request->all());

        #同步高德地图中的数据,因为一个地址会对应多个咨询业务，所以可能会需要修改多项
        $consults = $location->consults;

        foreach($consults as $consult){
            $poi = $consult->poi;
            $poi->updateInfo([
                '_address' => $request->get('address')
            ]);
        }

        return redirect('/location');
    }

    # 删除一个地址信息
    public function destroy(Request $request, Location $location)
    {
        $location->delete();
        return redirect('/location');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

    public function getBindLocation()
    {
        return view('location.bind');
    }

    public function postBindLocation(Request $request)
    {
        $home = $request->get('home');
        $work = $request->get('work');

        $home_location = new Location();
        $home_location->type = 'home';
        $home_location->address = $home;
        $home_location->save();

        $work_location = new Location();
        $work_location->type = 'work';
        $work_location->address = $work;
        $work_location->save();

        Auth::user()->locations()->saveMany([$home_location,$work_location]);

        return redirect('category');
    }
}
