<?php
namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    public $viewDir = "bill";

    public function index()
    {
        $records = Bill::findRequested();
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
        $this->validate($request, Bill::validationRules());

        Bill::create($request->all());

        return redirect('/bill');
    }

    /**
     * Display the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function show(Request $request, Bill $bill)
    {
        return $this->view("show",['bill' => $bill]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return  \Illuminate\Http\Response
     */
    public function edit(Request $request, Bill $bill)
    {
        return $this->view( "edit", ['bill' => $bill] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        if( $request->isXmlHttpRequest() )
        {
            $data = [$request->name  => $request->value];
            $validator = \Validator::make( $data, Bill::validationRules( $request->name ) );
            if($validator->fails())
                return response($validator->errors()->first( $request->name),403);
            $bill->update($data);
            return "Record updated";
        }

        $this->validate($request, Bill::validationRules());

        $bill->update($request->all());

        return redirect('/bill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return  \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bill $bill)
    {
        $bill->delete();
        return redirect('/bill');
    }

    protected function view($view, $data = [])
    {
        return view($this->viewDir.".".$view, $data);
    }

}
