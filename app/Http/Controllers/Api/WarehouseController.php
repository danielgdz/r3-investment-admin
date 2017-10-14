<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController as Controller;
use App\Models\Warehouse;
use App\Models\Wine;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                    ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                    ->get();
                
        return $list;
    }

    /**
     * Display a simple listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSimpleList(Request $request)
    {
        $list = Warehouse::select(Warehouse::TABLE_NAME . '.id', Warehouse::TABLE_NAME . '.name',
                        Warehouse::TABLE_NAME . '.code')
                    ->whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                    ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                    ->get();
        
        return $list;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function show($id)
    {
        $object = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                    ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                    ->find($id);
	
	if (!is_null($object)){
		$object->description = json_decode($object->description);
	}

        return $object;
    }
        
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function showWithProducts($id)
    {
        $object = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                    ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                    ->find($id);
            
        if (!is_null($object)) {
            if (!is_null($object->images)) {
                if (!is_array($object->images)) {
                    $object->images = json_decode($object->images);
                }
            }

            if (!is_null($object->images)) {
                if (is_string($object->images)) {
                    $object->images = json_decode($object->images);
                }
            }

            $products = Wine::select(Wine::TABLE_NAME . '.id',
                    Wine::TABLE_NAME . '.name', Wine::TABLE_NAME . '.short_description',
                    Wine::TABLE_NAME . '.stars', Wine::TABLE_NAME . '.url_image')
                ->whereNull(Wine::TABLE_NAME . '.deleted_at')
                ->where(Wine::TABLE_NAME . '.flag_active', Wine::STATE_ACTIVE)
                ->where(Wine::TABLE_NAME . '.warehouses_id', $object->id)
                ->get();
            
            $object->products = $products;
        }

        return $object;
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
