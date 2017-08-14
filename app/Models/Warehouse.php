<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
	protected $connection = 'mysql';
	
    const TABLE_NAME = 'warehouses';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id','name','description','images','url_image','comments',
		//auditoria
		'flag_active','created_at','updated_at','deleted_at'
    ];

    public function getFillable()
    {
        # code...
        return $this->fillable;
    }

    protected $cast = [
        'description' => 'array',
        'images' => 'array',
        'comments' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}
