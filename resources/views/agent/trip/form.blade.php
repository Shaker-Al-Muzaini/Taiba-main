@extends('agent.layouts.app')

@push('css')
    <style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
    <style>
        .form-control {
            text-align: right;
        }
    </style>
@endpush
@section('content')
    <agent-trip-form :home-url="'{{route('agent.mange.trip.index')}}'"
                     :trip="{{isset($trip)?$trip:0}}"
                     inline-template>


        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-bus">
                    </i>
                    &nbsp;
                    رحلة جديدة
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <div class="card-body">

                <form class="kt-form kt-form--label-right">


                    <div class="form-group row mb-3">
                        <label for="name1" class="col-sm-2 col-form-label">المنطقة</label>
                        <div class="col-sm-10">
                            <multiselect v-model="state"
                                         :options="statesList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         label="name"
                                         track-by="id"
                                         placeholder="اختر المنطقة ">
                            </multiselect>


                            <span v-if="form.error && form.validations.state"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.state[0] }}
                        </span>

                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="name1" class="col-sm-2 col-form-label">الزبون</label>
                        <div class="col-sm-10 ">
                            <multiselect v-model="customer"
                                         :options="customersList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         :custom-label="customerLabel"
                                         track-by="id"
                                         class="mb-3"
                                          v-if="!is_new_customer"
                                         placeholder="اختر الزبون">
                            </multiselect>


                        <span v-if="form.error && form.validations.customer && !is_new_customer"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.customer[0] }}
                        </span>
                            <input  v-if="is_new_customer" type="text" class="form-control form-control-solid text-right mb-3" id="customer_name"
                                   placeholder="اسم الزبون جديد" name="customer_name"
                                   v-model="customer_name" autocomplete="off" aria-autocomplete="off">
                            <span v-if="form.error && form.validations.customer_name && is_new_customer"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.customer_name[0] }}
                        </span>

                            <input  v-if="is_new_customer" type="text" class="form-control form-control-solid text-right mb-3" id="customer_mobile"
                                   placeholder="رقم الزبون جديد" name="customer_mobile"
                                   v-model="customer_mobile" autocomplete="off" aria-autocomplete="off">
                            <span v-if="form.error && form.validations.customer_mobile && is_new_customer"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.customer_mobile[0] }}
                        </span>

                            <multiselect v-if="is_new_customer"  v-model="customer_state"
                                         :options="statesList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         label="name"
                                         track-by="id"
                                         placeholder="اختر المنطقة ">
                            </multiselect>
                            <el-checkbox v-model="is_new_customer">  زبون جديد  </el-checkbox>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="name1" class="col-sm-2 col-form-label">نوع الحجز</label>
                        <div class="col-sm-10">
                            <multiselect v-model="reservation_type_id"
                                         :options="tripTypesList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         label="name"
                                         track-by="id"
                                         placeholder="اختر نوع الحجز">
                            </multiselect>


                            <span v-if="form.error && form.validations.reservation_type_id"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.reservation_type_id[0] }}
                        </span>

                        </div>
                    </div>

                    <div class="form-group row mb-3" v-if="reservation_type_id  && reservation_type_id.id==7">
                        <label for="name1" class="col-sm-2 col-form-label"> </label>
                        <div class="col-sm-10 col-sm-offset-2">
                            <input type="text" class="form-control form-control-solid text-right" id="reservation_type_text"
                                   placeholder="نوع الحجز " name="reservation_type_text"
                                   v-model="reservation_type_text" autocomplete="off" aria-autocomplete="off">
                            <span
                                v-if="form.error && form.validations.reservation_type_text"
                                class="help-block invalid-feedback">
                              @{{ form.validations.reservation_type_text[0] }}
                        </span>
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="date" class="col-sm-2 col-form-label">تاريخ الرحلة </label>
                        <div class="col-sm-10">

                            <el-date-picker
{{--                                @input="handleDateChange(scope.$index, $event, scope.row)"--}}
                                v-model="date"
                                type="date"
                                placeholder="تاريخ الرحلة">
                            </el-date-picker>
                            <span
                                v-if="form.error && form.validations.date"
                                class="help-block invalid-feedback">
                              @{{ form.validations.date[0] }}
                        </span>
                        </div>
                    </div>











                    <div class="form-group row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">  عدد الحافلات </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-solid text-right" id="price"
                                   placeholder="عدد الحافلات" name="price" v-model="vehicles_count"
                                   @keypress="isNumber"
                            >
                            <span v-if="form.error && form.validations.vehicles_count"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.vehicles_count[0] }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="payment_type" class="col-sm-2 col-form-label">
                            نوع الحافلة
                        </label>
                        <div class="col-sm-10">

                            <div class="fv-row">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="[vehicle_type=='small'?'active':'']"  data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  :checked="vehicle_type=='small'?'checked':''" value="small" v-model="vehicle_type" />
                                        <!--end::Input-->
                                        صغيرة
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success "  :class="[vehicle_type=='large'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  :checked="vehicle_type=='large'?'checked':''" value="large" v-model="vehicle_type"  />
                                        <!--end::Input-->
                                        كبيرة
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->


                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="payment_type" class="col-sm-2 col-form-label">
                            نوع الحجز
                        </label>
                        <div class="col-sm-10">

                            <div class="fv-row">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="[!trip||trip_type=='going'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  :checked="trip_type=='going'?'checked':''" value="going" v-model="trip_type" />
                                        <!--end::Input-->
                                        ذهاب
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="[trip_type=='back'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  :checked="trip_type=='back'?'checked':''" value="back" v-model="trip_type"  />
                                        <!--end::Input-->
                                       عودة
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="[trip_type=='going_and_back'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  :checked="trip_type=='going_and_back'?'checked':''" value="going_and_back" v-model="trip_type"  />
                                        <!--end::Input-->
                                        ذهاب وعودة
                                    </label>
                                    <!--end::Radio-->



                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6 col-offset-2 going " v-if="trip_type=='going' || trip_type=='going_and_back'">
                            <div class="form-group row  mb-3">
                                <label for="arrival_time" class="col-4 col-form-label">وقت الوصول </label>
                                <div class="col-6">
                                    <b-form-timepicker v-model="arrival_time" locale="ar"></b-form-timepicker>




                                    <span
                                        v-if="form.error && form.validations.arrival_time"
                                        class="help-block invalid-feedback">
                              @{{ form.validations.arrival_time[0] }}
                        </span>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="name1" class="col-4 col-form-label">سائق الذهاب </label>
                                <div class="col-6">
                                    <multiselect v-model="going_driver_id"
                                                 :options="driversList"
                                                 :searchable="true"
                                                 :close-on-select="true"
                                                 :show-labels="true"
                                                 label="name"
                                                 track-by="id"
                                                 placeholder="اختر سائق الذهاب">
                                    </multiselect>


                                    <span v-if="form.error && form.validations.going_driver_id"
                                          class="help-block invalid-feedback">
                              @{{ form.validations.going_driver_id[0] }}
                        </span>

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="going_vehicle_id" class="col-4 col-form-label">باص الذهاب </label>
                                <div class="col-6">
                                    <multiselect v-model="going_vehicle_id"
                                                 :options="vehicleList"
                                                 :searchable="true"
                                                 :close-on-select="true"
                                                 :show-labels="true"
                                                 label="vehicle_number"
                                                 track-by="id"
                                                 placeholder="اختر باض الذهاب">
                                    </multiselect>


                                    <span v-if="form.error && form.validations.going_vehicle_id"
                                          class="help-block invalid-feedback">
                              @{{ form.validations.going_vehicle_id[0] }}
                        </span>

                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="invoice_number" class="col-4 col-form-label">مسار الذهاب </label>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-solid text-right" id="going_path"
                                           placeholder="مسار الذهاب " name="going_path"
                                           v-model="going_path" autocomplete="off" aria-autocomplete="off">
                                             <span
                                                    v-if="form.error && form.validations.going_path"
                                                    class="help-block invalid-feedback">
                                          @{{ form.validations.going_path[0] }}
                                    </span>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label for="invoice_number" class="col-4 col-form-label">ملاحظات الذهاب  </label>
                                <div class="col-6">

                                    <textarea class="form-control form-control-solid text-right" v-model="going_note" rows="7"></textarea>
                                    <span
                                        v-if="form.error && form.validations.going_note"
                                        class="help-block invalid-feedback">
                                          @{{ form.validations.going_note[0] }}
                                    </span>
                                </div>
                            </div>


                        </div>
                        <div class="col-6 col-offset-2 back" v-if="trip_type=='back' || trip_type=='going_and_back'">
                            <div class="form-group row ">
                                <label for="return_time" class="col-4 col-form-label">وقت العودة</label>
                                <div class="col-6">
                                    <b-form-timepicker v-model="return_time" locale="ar"></b-form-timepicker>




                                    <span v-if="form.error && form.validations.return_time"
                                          class="help-block invalid-feedback">
                              @{{ form.validations.return_time[0] }}
                        </span>
                                </div>
                            </div>



                            <div class="form-group row mb-3">
                                <label for="name1" class="col-4 col-form-label">سائق العودة </label>
                                <div class="col-6">
                                    <multiselect v-model="back_driver_id"
                                                 :options="driversList"
                                                 :searchable="true"
                                                 :close-on-select="true"
                                                 :show-labels="true"
                                                 label="name"
                                                 track-by="id"
                                                 placeholder="اختر سائق العودة">
                                    </multiselect>


                                    <span v-if="form.error && form.validations.back_driver_id"
                                          class="help-block invalid-feedback">
                              @{{ form.validations.back_driver_id[0] }}
                        </span>

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="going_vehicle_id" class="col-4 col-form-label">باص العودة </label>
                                <div class="col-6">
                                    <multiselect v-model="back_vehicle_id"
                                                 :options="vehicleList"
                                                 :searchable="true"
                                                 :close-on-select="true"
                                                 :show-labels="true"
                                                 label="vehicle_number"
                                                 track-by="id"
                                                 placeholder="اختر باض العودة">
                                    </multiselect>


                                    <span v-if="form.error && form.validations.back_vehicle_id"
                                          class="help-block invalid-feedback">
                                         @{{ form.validations.back_vehicle_id[0] }}
                                    </span>

                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="invoice_number" class="col-4 col-form-label">مسار العودة </label>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-solid text-right" id="back_path"
                                           placeholder="مسار العودة " name="back_path"
                                           v-model="back_path" autocomplete="off" aria-autocomplete="off">
                                    <span
                                        v-if="form.error && form.validations.back_path"
                                        class="help-block invalid-feedback">
                                          @{{ form.validations.back_path[0] }}
                                    </span>
                                </div>
                            </div>


                            <div class="form-group row mb-3">
                                <label for="invoice_number" class="col-4 col-form-label">ملاحظات العودة  </label>
                                <div class="col-6">

                                    <textarea class="form-control form-control-solid text-right" v-model="back_note" rows="7"></textarea>
                                    <span
                                        v-if="form.error && form.validations.back_note"
                                        class="help-block invalid-feedback">
                                          @{{ form.validations.back_note[0] }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">السعر (شيكل) </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-solid text-right" id="price"
                                   placeholder="السعر" name="price" v-model.number="price"
                                   @keypress="isNumber">
                            <span v-if="form.error && form.validations.price"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.price[0] }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="prepaid_price" class="col-sm-2 col-form-label">دفعة (شيكل) </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-solid text-right" id="prepaid_price"
                                   placeholder="دفعة" name="prepaid_price" v-model="prepaid_price"
                                   @keypress="isNumber">
                            <span v-if="form.error && form.validations.prepaid_price"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.prepaid_price[0] }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="remaining_price" class="col-sm-2 col-form-label">المبلغ المتبقي (شيكل) </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-solid text-right" id="remaining_price"
                                   placeholder="المتبقي" name="remaining_price" v-model="remaining_price"
                                   @keypress="isNumber">
                            <span v-if="form.error && form.validations.remaining_price"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.remaining_price[0] }}
                        </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="payment_type" class="col-sm-2 col-form-label">
                                طريقة الدفع
                        </label>
                        <div class="col-sm-10">

                            <div class="fv-row">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="[!trip||payment_type=='cash'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"   :checked="payment_type=='cash'?'checked':''" value="cash" v-model="payment_type" />
                                        <!--end::Input-->
                                       كاش
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success "  :class="[payment_type=='cheque'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method"  value="cheque" :checked="payment_type=='cheque'?'checked':''" v-model="payment_type"  />
                                        <!--end::Input-->
                                        شيك
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" :class="[payment_type=='bank'?'active':'']" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="bank" :checked="payment_type=='bank'?'checked':''"  v-model="payment_type"/>
                                        <!--end::Input-->
                                        حوالة بنكية
                                    </label>
                                    <!--end::Radio-->

                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="collector_driver_id" class="col-sm-2 col-form-label">جهة التحصيل</label>
                        <div class="col-sm-10">
                            <multiselect v-model="collector_driver_id"
                                         :options="driversList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         label="name"
                                         track-by="id"
                                         placeholder="جهة التحصيل">
                            </multiselect>

                            <span v-if="form.error && form.validations.collector_driver_id"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.collector_driver_id[0] }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3" v-if="collector_driver_id && collector_driver_id.id==38">
                        <label for="reserved_driver_id" class="col-sm-2 col-form-label">أخرى</label>
                        <div class="col-sm-10">
                            <input
                                type="text" class="form-control form-control-solid text-right mb-3"
                                placeholder="جهة التحصيل" name="customer_name"
                                v-model="collector_driver" autocomplete="off" aria-autocomplete="off">
                            <span v-if="form.error && form.validations.collector_driver "
                                  class="help-block invalid-feedback">
                              @{{ form.validations.collector_driver[0] }}
                        </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="reserved_driver_id" class="col-sm-2 col-form-label">طرف الحجز</label>
                        <div class="col-sm-10">
                            <multiselect v-model="reserved_driver_id"
                                         :options="driversList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         label="name"
                                         track-by="id"
                                         placeholder="طرف الحجز ">
                            </multiselect>

                            <span v-if="form.error && form.validations.reserved_driver_id"
                                  class="help-block invalid-feedback">
                              @{{ form.validations.reserved_driver_id[0] }}
                        </span>
                        </div>
                    </div>
                    <div class="form-group row mb-3" v-if="reserved_driver_id && reserved_driver_id.id==38">
                        <label for="reserved_driver_id" class="col-sm-2 col-form-label">أخرى</label>
                        <div class="col-sm-10">
                            <input
                                type="text" class="form-control form-control-solid text-right mb-3"
                                placeholder="طرف الحجز" name="customer_name"
                                v-model="reserved_driver" autocomplete="off" aria-autocomplete="off">
                            <span v-if="form.error && form.validations.reserved_driver "
                                  class="help-block invalid-feedback">
                              @{{ form.validations.reserved_driver[0] }}
                        </span>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="note" class="col-sm-2 col-form-label">البيان </label>
                        <div class="col-sm-10">

                            <textarea v-model="note" rows="5" class="form-control form-control-solid text-right">@{{ note }}</textarea>
                            <span
                                v-if="form.error && form.validations.note"
                                class="help-block invalid-feedback">
                              @{{ form.validations.note[0] }}
                        </span>
                        </div>
                    </div>



{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="agent" class="col-sm-2 col-form-label">السائقين</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <multiselect--}}
{{--                                v-model="drivers"--}}
{{--                                placeholder="ابحث عن سائق"--}}
{{--                                label="name"--}}
{{--                                track-by="id"--}}
{{--                                :options="driversList"--}}
{{--                                :multiple="true"--}}
{{--                                :taggable="true">--}}
{{--                            </multiselect>--}}

{{--                        <span v-if="form.error && form.validations.agent"--}}
{{--                                  class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.agent[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                </form>

            </div>
            <div class="card-footer">
               <button type="button" @click="storeTrip" class="btn   btn-primary">
                   إضافة  الرحلة
               </button>

                <a href="{{route('agent.mange.trip.index')}}" class="btn btn-secondary">
                    إلغاء الأمر
                </a>
            </div>

        </div>
    </agent-trip-form>
@endsection
