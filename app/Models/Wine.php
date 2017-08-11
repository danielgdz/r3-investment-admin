<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wine extends Model
{
	protected $connection = 'mysql';
	
    const TABLE_NAME = 'wines';
    const STATE_ACTIVE = true;
    const STATE_INACTIVE = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'id','warehouses_id','name','description','stars',
        'images','url_image','url_pdf','tech_details',
        'short_description',
		//auditoria
		'flag_active','created_at','updated_at','deleted_at'
    ];

    public function getFillable()
    {
        # code...
        return $this->fillable;
    }

    protected $cast = [
        'images' => 'array',
        'tech_details' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = self::TABLE_NAME;
}
