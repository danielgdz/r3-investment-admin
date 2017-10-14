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
            $warehouse = new Warehouse();
            if (isset($data['images'])) {
                $data = $this->uploadImages($data, $request->file('images'));
                $images = new \stdClass();
                foreach ($data['images'] as $key => $value) {
                    foreach ($value as $option => $url) {
                        if (isset($images->$key)) {
                            $images->$key->$option = $url;
                        } else {
                            $images->$key = new \stdClass();
                            $images->$key->$option = $url;
                        }
                    }
                }
                $warehouse->images = json_encode($images);
            }
            
            $warehouse->name = $data['name'];
            $warehouse->code = $data['code'];
            $warehouse->description = json_encode($data['description']);
            $warehouse->flag_active = $data['flag_active'];
            $warehouse->save();

            return redirect('/' . self::VIEW_PATH_NAME);
        }
    }

    private function uploadImages($data = [], $images) {
        //Image 0
        if (isset($images[0])) {
            foreach ($images[0] as $key => $value) {
                $image = $images[0][$key];
                if (!is_null($image)) {
                    $imagename = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/warehouses');
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath . '/' . $imagename);
                    $image->move($destinationPath, $imagename);
                    $data['images'][0][$key] = '/images/warehouses/' . $imagename;
                }
            }
        }
        //Image 1
        if (isset($images[1])) {
            foreach ($images[1] as $key => $value) {
                $image = $images[1][$key];
                if (!is_null($image)) {
                    $imagename = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/warehouses');
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath . '/' . $imagename);
                    $image->move($destinationPath, $imagename);
                    $data['images'][1][$key] = '/images/warehouses/' . $imagename;
                }
            }
        }
        //Image 2
        if (isset($images[2])) {
            foreach ($images[2] as $key => $value) {
                $image = $images[2][$key];
                if (!is_null($image)) {
                    $imagename = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/images/warehouses');
                    $img = Image::make($image->getRealPath());
                    $img->save($destinationPath . '/' . $imagename);
                    $image->move($destinationPath, $imagename);
                    $data['images'][2][$key] = '/images/warehouses/' . $imagename;
                }
            }
        }
        
        return $data;
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
            $warehouse->description = json_decode($warehouse->description);
            $warehouse->images = json_decode($warehouse->images);
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
            if (isset($data['images'])) {
                $data = $this->uploadImages($data, $request->file('images'));
                if (is_null($warehouse->images)) {
                    $images = new \stdClass();
                } else {
                    $images = json_decode($warehouse->images);
                }
                foreach ($data['images'] as $key => $value) {
                    foreach ($value as $option => $url) {
                        if (isset($images->$key)) {
                            $images->$key->$option = $url;
                        } else {
                            $images->$key = new \stdClass();
                            $images->$key->$option = $url;
                        }
                    }
                }
                $warehouse->images = json_encode($images);
            }

            $warehouse->name = $data['name'];
            $warehouse->code = $data['code'];
            $warehouse->description = json_encode($data['description']);
            $warehouse->flag_active = $data['flag_active'];
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
