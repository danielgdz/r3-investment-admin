<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController as Controller;
use App\Models\Warehouse;
use App\Models\Wine;
use DB;

class WineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $list = Wine::Join(Warehouse::TABLE_NAME, Wine::TABLE_NAME . '.warehouses_id', '=', Warehouse::TABLE_NAME . '.id')
                ->select(DB::raw(Warehouse::TABLE_NAME . '.name as warehouse_name'), Wine::TABLE_NAME . '.*')
                ->whereNull(Wine::TABLE_NAME . '.deleted_at')
                ->where(Wine::TABLE_NAME . '.flag_active', Wine::STATE_ACTIVE)
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
        //
        $object = Wine::Join(Warehouse::TABLE_NAME, Wine::TABLE_NAME . '.warehouses_id', '=', Warehouse::TABLE_NAME . '.id')
                ->select(DB::raw(Warehouse::TABLE_NAME . '.name as warehouse_name'), Wine::TABLE_NAME . '.*')
                ->whereNull(Wine::TABLE_NAME . '.deleted_at')
                ->where(Wine::TABLE_NAME . '.flag_active', Wine::STATE_ACTIVE)
                ->find($id);

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
