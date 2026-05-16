<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equity extends Model
{
    protected $fillable = [
    'company_name',
    'periode',
    'investment_amount',
    'profit_loss_amount',
    'roi_percentage',
    'note',
];
}