<?php
namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use App\Item;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Location $location)
    {
        return $this->view("show",['location' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Location $location)
    {
        return $this->view( "edit", ['location' => $location] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Location $location)
    {
        $location->delete();
        return redirect('/location');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
