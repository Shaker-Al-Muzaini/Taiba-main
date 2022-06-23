
<html dir="rtl" >
<head>
    <style>
            table th{
                background: whitesmoke;

            }
            table td,table th{
                border:1px solid black;
            }
            .text-center{
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الزبون</th>
                <th>رقم جوال الزبون</th>
                <th>المنطقة</th>
                <th>عدد الحافلات</th>
                <th>نوع الحافلة</th>
                <th>نوع الحجز</th>
                <th>سائق الذهاب</th>
                <th>حافلة الذهاب</th>
                <th>وقت الوصول</th>
                <th>مسار الذهاب</th>
                <th>ملاحظات الذهاب</th>
                <th>سائق العودة</th>
                <th>حافلة العودة</th>
                <th>وقت العودة</th>
                <th>مسار العودة</th>
                <th>ملاحظات العودة</th>
                <th>التاريخ</th>
                <th>السعر</th>
                <th>طريقة الدفع</th>
                <th>جهة التحصيل</th>
                <th>طرف الحجز</th>
                <th>المندوب</th>
                <th>الملاحظات</th>

            </tr>
        </thead>
        <tbody>
        @foreach($trips as $key=>$trip)
            <tr>
                <td>{{$key+1}}</td>
                <td class="text-right">{{@$trip->customer->name}}</td>
                <td class="text-center">{{@$trip->customer->mobile}}</td>
                <td class="text-center">{{@$trip->state->name}}</td>
                <td class="text-center">{{@$trip->vehicles_count}}</td>
                <td class="text-center">{{@$trip->vehicle_type}}</td>
                <td class="text-center">{{@$trip->type}}</td>


                <td class="text-right">{{@$trip->goingDriver->name}}</td>
                <td class="text-center">{{@$trip->goingVehicle->vehicle_number}}</td>
                <td class="text-center">{{@$trip->arrival_time}}</td>
                <td class="text-right">{{@$trip->going_path}}</td>
                <td class="text-right">{{@$trip->going_note}}</td>

                <td class="text-right">{{@$trip->backDriver->name}}</td>
                <td class="text-center">{{@$trip->backVehicle->vehicle_number}}</td>
                <td class="text-center">{{@$trip->return_time}}</td>
                <td class="text-right">{{@$trip->back_path}}</td>
                <td class="text-right">{{@$trip->back_note}}</td>

                <td class="text-right">{{@$trip->date}}</td>
                <td class="text-right">{{@$trip->price}}</td>
                <td class="text-right">{{@$trip->payment_type_label}}</td>
                <td class="text-right">{{@$trip->collector->id==38?$trip->collector_driver:@$trip->collector->name}}</td>
                <td class="text-right">{{@$trip->reserver->id==38?$trip->reserved_driver:@$trip->reserver->name}}</td>
                <td class="text-right">{{@$trip->agent->name}}</td>
                <td class="text-right">{{@$trip->note}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
