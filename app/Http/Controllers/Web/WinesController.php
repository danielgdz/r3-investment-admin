<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\Wine;
use Image;
use DB;
use Illuminate\Support\Facades\Storage;

class WinesController extends Controller
{
    const VIEW_PATH_NAME = 'wines';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Wine::join(Warehouse::TABLE_NAME, Wine::TABLE_NAME . '.warehouses_id', '=',
                            Warehouse::TABLE_NAME . '.id')
                        ->select(DB::raw(Warehouse::TABLE_NAME . '.name as warehouse_name'), Wine::TABLE_NAME . '.*')
                        ->whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                        ->whereNull(Wine::TABLE_NAME . '.deleted_at')
                        ->where(Wine::TABLE_NAME . '.flag_active', Wine::STATE_ACTIVE)
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
        $warehouses = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                    ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                    ->select(Warehouse::TABLE_NAME . '.id', Warehouse::TABLE_NAME . '.name')
                    ->get();

        return view(self::VIEW_PATH_NAME . '.form', compact('warehouses', $warehouses));
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
                $destinationPath = public_path('/images/wines');
                $img = Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);
                $image->move($destinationPath, $input['imagename']);
                $data['url_image'] = '/images/wines/' . $input['imagename'];
            } else {
                unset($data['url_image']);
            }
            
            $pdf = $request->file('url_pdf');
            
            if (!is_null($pdf)) {    
                // $input['pdfname'] = time().'.'.$pdf->getClientOriginalExtension();
                // $destinationPath = public_path('/pdfs/wines');
                // $img = \File::make($pdf->getRealPath());
                // $img->save($destinationPath . '/' . $input['pdfname']);
                // $pdf->move($destinationPath, $input['pdfname']);
                // $data['url_image'] = '/pdfs/wines/' . $input['pdfname'];
            } else {
                unset($data['url_pdf']);
            }

            $wine = new Wine();
            $wine->create($data);

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
        $wine = Wine::whereNull(Wine::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($wine)) {
            $warehouses = Warehouse::whereNull(Warehouse::TABLE_NAME . '.deleted_at')
                        ->where(Warehouse::TABLE_NAME . '.flag_active', Warehouse::STATE_ACTIVE)
                        ->select(Warehouse::TABLE_NAME . '.id', Warehouse::TABLE_NAME . '.name')
                        ->get();

            return view(self::VIEW_PATH_NAME . '.edit', compact('wine', $wine, 'warehouses', $warehouses));
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
        $wine = Wine::whereNull(Wine::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($wine)) {   
            $data = $request->all();
            $image = $request->file('url_image');
            
            if (!is_null($image)) {    
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/wines');
                $img = \Image::make($image->getRealPath());
                $img->save($destinationPath . '/' . $input['imagename']);
                $image->move($destinationPath, $input['imagename']);
                $data['url_image'] = '/images/wines/' . $input['imagename'];
            } else {
                unset($data['url_image']);
            }

            $pdf = $request->file('url_pdf');
            
            if (!is_null($pdf)) {    
                // $input['pdfname'] = time().'.'.$pdf->getClientOriginalExtension();
                // $destinationPath = public_path('/pdfs/wines');

                // $data['url_pdf'] =  '/pdfs/wines/' . $input['pdfname'];

                // Storage::disk('local')->put($input['pdfname'],  \File::get($pdf));
            } else {
                unset($data['url_pdf']);
            }

            $wine->fill($data);
            $wine->save();

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
        $wine = Wine::whereNull(Wine::TABLE_NAME . '.deleted_at')->find($id);
        if (!is_null($wine)) {
            $wine->flag_active = Wine::STATE_INACTIVE;
            $wine->deleted_at = date('Y-m-d H:i:s');
            $wine->save();

            return redirect('/' . self::VIEW_PATH_NAME);
        }
    }
}
