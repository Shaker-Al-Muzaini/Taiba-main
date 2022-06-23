@extends('agent.layouts.app')

@push('css')
    <style>
        .table-component__filter {
            display: none;
        }

        .el-date-editor {
            width: 500px !important;
        }

        .el-date-range-picker__content {
            float: right !important;
        }
    </style>
@endpush
@section('content')
    <agent-trips-list :fetch-data-url="'{{route('agent.mange.trip.othersSearch')}}'"
                      :role="'admin'"
                      inline-template>
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-bus">
                    </i>
                    &nbsp;
                    إدارة الحجوزات
                </h3>
                <div class="card-toolbar">
                    <a href="{{route('agent.mange.trip.create')}}" class="btn  btn-sm btn-primary">
                        <i class="flaticon2-add-1"></i>
                        إضافة حجز جديدة
                    </a>
                </div>
            </div>
            <div class="card-body" style="overflow-x: scroll">
                <div class="row">
                    <el-date-picker
                        v-model="custom_period"
                        type="daterange"
                        align="right"
                        unlink-panels
                        range-separator="To"
                        start-placeholder="Start date"
                        end-placeholder="End date"
                        value-format="yyyy-MM-dd">
                    </el-date-picker>
                </div>
                <table-component
                    :data="fetchData"
                    :table-class="'table table-hover kt-datatable__table'"
                    :filter-input-class="'form-control'"
                    filter-placeholder="بحث "
                    :show-caption="false"
                    sort-by="created_at"
                    :filter-no-results="'لا يوجد نتائج'"
                    {{--                                         :sort-order="name_en"--}}
                    ref="adminTable"
                >

                    <table-column label="#" :sortable="false" :filterable="false">
                        <template scope="trip">
                            @{{((currentPage-1) * per_page)+ data.indexOf(trip)+1}}
                        </template>
                    </table-column>
                    {{--                                <table-column label="رقم التسجيل" show="reg_no"></table-column>--}}

                    {{----}}
                    <table-column label="اسم الزبون" :sortable="false" :filterable="false">
                        <template scope="trip">
                            @{{trip.customer.name}}
                        </template>
                    </table-column>
                    <table-column label="جوال الزبون" :sortable="false" :filterable="false">
                        <template scope="trip">
                            @{{trip.customer.mobile}}
                        </template>
                    </table-column>
                    <table-column label="المنطقة" show="state_name"></table-column>
                    <table-column label="غرض الحجز" :sortable="false" :filterable="false">
                        <template scope="trip">
                            @{{trip.reservation_type.name??''}}
                        </template>
                    </table-column>
                    <table-column label="عدد الحافلات" :sortable="false" :filterable="false">
                        <template scope="trip">
                            @{{trip.vehicles_count}}
                        </template>
                    </table-column>
                    <table-column label="نوع الحجز" show="type"></table-column>
                    <table-column label="تاريخ الحجز" :sortable="false" :filterable="false">
                        <template scope="user">
                            @{{dateFormatter(user.date)}}
                        </template>
                    </table-column>
                    <table-column label="وقت الوصول" show="arrival_time"></table-column>
                    <table-column label="وقت العودة" show="return_time"></table-column>
                    <table-column label="السعر (شيكل) " show="price"></table-column>
                    <table-column label="المتبقي (شيكل) " show="remaining_price"></table-column>
                    <table-column label="اسم السائق">
                        <template scope="trip">

                            <div v-if="trip.going_driver">ذهاب : @{{ trip.going_driver?trip.going_driver.name:''}}</div>
                            <div v-if="trip.back_driver">عودة : @{{ trip.back_driver?trip.back_driver.name:''}}</div>
                        </template>
                    </table-column>

                    {{--                                <table-column label="تاريخ الإضافة" :sortable="false" :filterable="false">                                --}}
                    {{--                                    <template scope="user">--}}
                    {{--                                        @{{dataFormatter(user.created_at)}}--}}
                    {{--                                    </template>--}}
                    {{--                                </table-column>--}}

                    <table-column label="طرف الحجز " :sortable="false" :filterable="false">
                        <template scope="trip">
                            <span v-if="trip.reserver">
                                @{{ trip.reserver.name }}
                            </span>
                        </template>
                    </table-column>
                    <table-column label="جهة التحصيل " :sortable="false" :filterable="false">
                        <template scope="trip">
                            <span v-if="trip.collector">
                                @{{ trip.collector.name }}
                            </span>
                        </template>
                    </table-column>
                    <table-column label="الاجراءات" :sortable="false" :filterable="false">
                        <template scope="user">

                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                               href="javascript:;" @click="handleTrip(user)">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>


                        </template>
                    </table-column>
                </table-component>


            </div>
            <el-dialog

                @closed="clearModelData"
                width="70%"
                :title="'عرض بيانات الحجز '"
                :visible.sync="innerViewVisible"
                :close-on-click-modal="false"
                append-to-body>

                <div class="row">
                    <div class="col-8">
                        <table class="table  table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>البيانات الرئيسية</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>منطقة</th>
                                <td>
                                       <span v-if="trip.state">
                                               @{{trip.state.name}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>اسم الزبون</th>
                                <td>
                                       <span v-if="trip.customer">
                                               @{{trip.customer.name}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th>موبايل الزبون</th>
                                <td>
                                       <span v-if="trip.customer">
                                               @{{trip.customer.mobile}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th>غرض الحجز</th>
                                <td>
                                       <span v-if="trip.reservation_type">
                                               @{{trip.reservation_type.name}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>تاريخ الحجز</th>
                                <td>
                                       <span v-if="trip.date">
                                               @{{trip.date}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th>عدد الحافلات</th>
                                <td>
                                       <span v-if="trip.vehicles_count">
                                               @{{trip.vehicles_count}}
                                       </span>

                                </td>
                            </tr>


                            <tr>
                                <th>نوع الحجز</th>
                                <td>
                                   <span v-if="trip.trip_type =='going'">
                                           ذهاب
                                   </span>
                                    <span v-if="trip.trip_type =='back'">
                                               عودة
                                   </span>
                                    <span v-if="trip.trip_type =='going_and_back'">
                                               ذهاب وعودة
                                   </span>
                                </td>
                            </tr>


                            <tr>
                                <th>السعر</th>
                                <td>
                                   <span v-if="trip.price">
                                           @{{ trip.price }}
                                   </span>

                                </td>
                            </tr>

                            <tr>
                                <th>دفعة</th>
                                <td>
                                   <span v-if="trip.prepaid_price">
                                           @{{ trip.prepaid_price }}
                                   </span>

                                </td>
                            </tr>


                            <tr>
                                <th>المبلغ المتبقي</th>
                                <td>
                                   <span v-if="trip.remaining_price">
                                           @{{ trip.remaining_price }}
                                   </span>

                                </td>
                            </tr>
                            <tr>
                                <th>طريقة الدفع</th>
                                <td>
                                   <span v-if="trip.payment_type =='cash'">
                                           كاش
                                   </span>
                                    <span v-if="trip.payment_type =='cheque'">
                                               شيك
                                   </span>
                                    <span v-if="trip.payment_type =='bank'">
                                            بنك
                                   </span>
                                </td>
                            </tr>
                            <tr>
                                <th> المندوب</th>
                                <td>
                                                   <span v-if="trip.agent">
                                                           @{{ trip.agent.name }}
                                                   </span>

                                </td>
                            </tr>

                            <tr>
                                <th> جهة التحصيل</th>
                                <td>
                                       <span v-if="trip.collector">
                                            @{{ trip.collector.name }}
                                        </span>

                                </td>
                            </tr>

                            <tr>
                                <th> طرف الحجز</th>
                                <td>
                                   <span v-if="trip.reserver">
                                        @{{ trip.reserver.name }}
                                    </span>

                                </td>
                            </tr>

                            <tr>
                                <th> الملاحظات</th>
                                <td>
                                   <span v-if="trip.note">
                                           @{{ trip.note }}
                                   </span>

                                </td>
                            </tr>


                            {{--                               @{{trip}}--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4">
                        <table v-if="trip.trip_type =='going' || trip.trip_type =='going_and_back'"
                               class="table  table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>بيانات الذهاب</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>وقت الوصول</th>
                                <td>
                                       <span v-if="trip.arrival_time">
                                               @{{trip.arrival_time}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>اسم السائق</th>
                                <td>
                                       <span v-if="trip.going_driver">
                                               @{{trip.going_driver.name}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th>باص الذهاب</th>
                                <td>
                                       <span v-if="trip.going_vehicle">
                                               @{{trip.going_vehicle.vehicle_number}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th> مسار الذهاب</th>
                                <td>
                                       <span v-if="trip.going_path">
                                               @{{trip.going_path}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>ملاحظات الذهاب</th>
                                <td>
                                       <span v-if="trip.going_note">
                                               @{{trip.going_note}}
                                       </span>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <table v-if="trip.trip_type =='back' || trip.trip_type =='going_and_back'"
                               class="table  table-striped table-hover ">
                            <thead>
                            <tr>
                                <th>بيانات العودة</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>وقت العودة</th>
                                <td>
                                       <span v-if="trip.return_time">
                                               @{{trip.return_time}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>اسم السائق</th>
                                <td>
                                       <span v-if="trip.back_driver">
                                               @{{trip.back_driver.name}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th>باص العودة</th>
                                <td>
                                       <span v-if="trip.back_vehicle">
                                               @{{trip.back_vehicle.vehicle_number}}
                                       </span>

                                </td>
                            </tr>

                            <tr>
                                <th> مسار العودة</th>
                                <td>
                                       <span v-if="trip.back_path">
                                               @{{trip.back_path}}
                                       </span>

                                </td>
                            </tr>
                            <tr>
                                <th>ملاحظات العودة</th>
                                <td>
                                       <span v-if="trip.back_note">
                                               @{{trip.back_note}}
                                       </span>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


                <el-button @click="innerViewVisible = false">إلغاء الأمر</el-button>
            </el-dialog>

        </div>
    </agent-trips-list>
@endsection
