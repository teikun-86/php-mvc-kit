<?php

namespace App\Models;

use App\Helpers\DB;

class Model
{
    protected $table;

    protected $timestamps = true;

    public function create(array $data)
    {
        $db = new DB;
        $db->setQueryTo(DB::CREATE);
        if($this->timestamps) {
            $data = array_merge($data, [
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ]);
        }
        return $db->create($data,$this->table);
    }
    
}