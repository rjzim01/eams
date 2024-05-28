<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    use HasFactory;

    public function assetitem_po_mst()
    {
        return $this->belongsTo(Assetitem_po_mst::class);
    }

    public function spareparts_po_mst()
    {
        return $this->belongsTo(Spareparts_po_mst::class);
    }

    public function categorymodel()
    {
        return $this->belongsTo(Categorymodel::class);
    }
    public function spartpart()
    {
        return $this->belongsTo(Spartpart::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
