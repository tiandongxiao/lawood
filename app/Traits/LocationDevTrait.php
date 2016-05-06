<?php
/**
 * Created by PhpStorm.
 * User: tiandongxiao
 * Date: 06/05/2016
 * Time: 16:20
 */

namespace App\Traits;

use Illuminate\Http\Request;
use App\Location;

trait LocationDevTrait
{
    /**
     * @return mixed
     */
    public function locations()
    {
        $locations = $this->user->locations;
        return view('lawyer.location.index',compact('locations'));
    }

    /**
     * @return mixed
     */
    public function createLocations()
    {
        return view('lawyer.location.create');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function postCreateLocations(Request $request)
    {
        $home = Location::create([
            'type'    => 'home',
            'address' => $request->get('home')
        ]);

        $work = Location::create([
            'type'    => 'work',
            'address' => $request->get('work')
        ]);

        $this->user->locations()->saveMany([$home,$work]);

        return redirect('lawyer/categories');
    }
}