<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equity extends Model
{
    protected $fillable = [
        'company_name',
        'investment_amount',
        'roi_percentage',
        'profit_loss_amount',
        'note',
    ];
}