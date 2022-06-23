<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'vehicles_count',
        'note',
        'date',
        'arrival_time',
        'return_time',
        'price',
        'prepaid_price',
        'remaining_price',
        'invoice_number',
        'payment_type',
        'agent_id',
        'customer_id',
        'reservation_type_id',
        'reservation_type_text',
        'vehicle_number',
        'vehicle_type',
        'trip_type',
        'going_note',
        'going_path',
        'back_note',
        'back_path',
        'going_driver_id',
        'back_driver_id',
        'going_vehicle_id',
        'back_vehicle_id',
        'state_id',
        'collection_by',
        'collector_driver_id',
        'reserved_driver_id',
        'collector_driver',
        'reserved_driver',
    ];
    protected $appends = ['payment_type_label','type','state_name'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }





    public function getPaymentTypeLabelAttribute()
    {
        if($this->payment_type){
            return [
                'cash' => 'كاش',
                'cheque' => 'شيك',
                'bank' => 'حوالة بنكية',
            ][$this->payment_type];
        }
        return '';

    }

//    public function drivers()
//    {
//        return $this->belongsToMany(
//            Driver::class,
//            'trip_drivers',
//            'trip_id',
//            'driver_id'
//        );
//        //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
//    }

    public function reservationType()
    {
        return $this->belongsTo(TripType::class, 'reservation_type_id')->withDefault(['id' => 0, 'name' => $this->reservation_type_text]);
    }

    public function collector()
    {
        return $this->belongsTo(Driver::class, 'collector_driver_id');
    }
    public function reserver()
    {
        return $this->belongsTo(Driver::class, 'reserved_driver_id');
    }
    public function goingDriver()
    {
        return $this->belongsTo(Driver::class, 'going_driver_id');
    }
    public function backDriver()
    {
        return $this->belongsTo(Driver::class, 'back_driver_id');
    }
   public function goingVehicle()
    {
        return $this->belongsTo(Vehicle::class, 'going_vehicle_id');
    }
    public function backVehicle()
    {
        return $this->belongsTo(Vehicle::class, 'back_vehicle_id');
    }

    public function getTypeAttribute()
    {
        $tripType='';
        switch ($this->trip_type){
            case "going":
                $tripType='ذهاب';
                break;
            case "back":
                $tripType='عودة';
                break;
            case "going_and_back":
                $tripType='ذهاب و عودة';
                break;
        }
        return $tripType;
    }
    public function state(){
        return $this->belongsTo(State::class,'state_id')->withTrashed();
    }
    public function getStateNameAttribute()
    {
        $state= $this->state;
        if($state){
            return $state->name;
        }
        return null;
    }
}
