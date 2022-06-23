<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripExcelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $collector=@$this->collector->id==38?$this->collector_driver:$this->collector->name;
        $reserver=@$this->reserver->id==38?$this->reserved_driver:$this->reserver->name;
        $reservation_type=@$this->reservationType->id==7?$this->reservation_type_text:$this->reservationType->name;
        return [
//            'id'=>$this->id,
            'invoice_number'=>$this->invoice_number,
            'customer_name'=>@$this->customer->name,
            'agent_name'=>@$this->agent->name,
            'reservation_type'=>@$reservation_type,
            'collector_name'=>@$collector,
            'reserver_name'=>@$reserver,
            'type'=>@$this->type,
            'state'=>@$this->state->name,
            'customer_mobile'=>@$this->customer->mobile,
            'vehicles_count'=>$this->vehicles_count,
            'date'=>$this->date,
            'arrival_time'=>$this->arrival_time,
            'return_time'=>$this->return_time,
            'price'=>$this->price,
            'prepaid_price'=>$this->prepaid_price,
            'remaining_price'=>$this->remaining_price,
            'payment_type'=>@$this->payment_type_label,
            'back_note'=>@$this->back_note,
            'back_path'=>@$this->back_path,
            'backVehicle'=>@$this->backVehicle->vehicle_number,
            'backDriver'=>@$this->backDriver->name,
            'going_note'=>@$this->going_note,
            'going_path'=>@$this->going_path,
            'goingVehicle'=>@$this->goingVehicle->vehicle_number,
            'goingDriver'=>@$this->goingDriver->name,
            'vehicle_type'=>@$this->vehicle_type=='small'?'صغيرة':'كبيرة',
            'trip_type'=>@$this->trip_type=='going'?'ذهاب':$this->trip_type=='back'?'عودة':'ذهاب وعودة',
        ];

    }
}
