<?php
namespace App\Http\Controllers;

use App\Gdmap;
use App\Traits\GdYunMapTrait;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GdmapController extends Controller
{
    use GdYunMapTrait;

    public $viewDir = "gdmap";

    public function index()
    {
        $records = Gdmap::findRequested();
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
        $this->validate($request, Gdmap::validationRules());

        $item = Gdmap::create($request->all());

        #添加数据到高德云图
        if($item){
            $yun_id = $this->addItem([
                '_name'    => $request->get('name'),
                '_address' => $request->get('address'),
                'category' => $request->get('category')
            ]);

            if($yun_id){
                #保存云图数据yun_id给指定映射项
                $item->yun_id = $yun_id;
                $item->save();
            }
        }

        return redirect('/gdmap');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Gdmap $gdmap)
    {
        return $this->view("show",['gdmap' => $gdmap]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Gdmap $gdmap)
    {
        return $this->view( "edit", ['gdmap' => $gdmap] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Gdmap $gdmap)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Gdmap::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $result = $gdmap->update($data);

            #更新高德云图中的数据项
            if($result){
                $this->updateItem([
                    '_id'      => $gdmap->yun_id,
                    '_name'    => $request->get('name'),
                    '_address' => $request->get('address'),
                    'category' => $request->get('category')
                ]);
            }
            return "Record updated";
        }

        $this->validate($request, Gdmap::validationRules());

        $result = $gdmap->update($request->all());

        #更新高德云图中的数据项
        if($result){
            $this->updateItem([
                '_id'      => $gdmap->yun_id,
                '_name'    => $request->get('name'),
                '_address' => $request->get('address'),
                'category' => $request->get('category')
            ]);
        }

        return redirect('/gdmap');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gdmap $gdmap)
    {
        $yun_id = $gdmap->yun_id;
        $result = $gdmap->delete();

        #删除高的云图中的数据项
        if($result){
           $this->deleteItems($yun_id);
        }
        return redirect('/gdmap');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }
}
