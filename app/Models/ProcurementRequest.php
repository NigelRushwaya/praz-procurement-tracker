<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcurementRequest extends Model
{
  protected $fillable =[
    'request_number',
    'procuring_entity',
    'description',
    'procurement_method',
    'status',
    'date_submitted',
  ] ; //
}
