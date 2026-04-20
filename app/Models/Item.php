<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Employee;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Status;
use App\Models\Supplier;

class Item extends Model
{
    protected $table = 'items';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'buy_price',
        'sell_price_estimate',
        'description',
        'photo',
        'warranty',
        'quantity',
        'unit',
        'pay_date',
        'arrival_date',
        'item_status_id',
        'item_condition_id',
        'category_id',
        'note',
        'employee_id',
        'supplier_id',
        'location_id',


    ];

    protected $casts = [
        'item_status_id' => 'integer',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function condition()
    {
        return $this->belongsTo(Condition::class, 'item_condition_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'item_status_id');
    }
    public function supplier()
    {
         return $this->belongsTo(Supplier::class);
    }
}
