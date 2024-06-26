<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spareparts_po_mst extends Model
{
    use HasFactory;

    public function assetItems()
    {
        return $this->hasMany(Assetitem_po_mst::class, 'po_gen_id', 'po_gen_id'); // Assuming 'id' is the primary key in Spareparts_po_mst
    }
}
