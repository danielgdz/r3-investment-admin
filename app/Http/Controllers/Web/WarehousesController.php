<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use Image;

class WarehousesController extends Controller
{
    const VIEW_PATH_NAME = 'warehouses';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                        ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                        ->get();

        return view(self::VIEW_PATH_NAME . '.index', compact('list', $list));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::VIEW_PATH_NAME . '.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (isset($data['id'])) {
            return $this->update($request, (int)$data['id']);
        } else {
            $image = $request->file('url_image');
            
            if (!is_null($image)) {    
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/warehouses');
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);
                $image->move($destinationPath, $input['imagename']);
                $data['url_image'] = '/images/warehouses/' . $input['imagename'];
            } else {
                unset($data['url_image']);
            }

            $warehouse = new Warehouse();
            $warehouse->create($data);

            return redirect('/' . self::VIEW_PATH_NAME);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($warehouse)) {
            return view(self::VIEW_PATH_NAME . '.edit', compact('warehouse', $warehouse));
        } else {
            return view('erros.404');
        }
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
        $warehouse = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($warehouse)) {   
            $data = $request->all();
            $image = $request->file('url_image');
            
            if (!is_null($image)) {    
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/warehouses');
                $img = \Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);
                $image->move($destinationPath, $input['imagename']);
                $data['url_image'] = '/images/warehouses/' . $input['imagename'];
            } else {
                unset($data['url_image']);
            }

            $warehouse->fill($data);
            $warehouse->save();

            return redirect('/' . self::VIEW_PATH_NAME);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($warehouse)) {
            $warehouse->flag_active = Warehouse::STATE_INACTIVE;
            $warehouse->deleted_at = date('Y-m-d H:i:s');
            $warehouse->save();

            return redirect('/' . self::VIEW_PATH_NAME);
        }
    }
}
