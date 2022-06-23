@extends('admin.layouts.app')

@push('css')
    <style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
    <style>
        .form-control {
            text-align: right;
        }
        .el-date-editor .el-range-separator{
            width: 9% !important;
        }
    </style>
@endpush
@section('content')
    <trip-export  inline-template>

        <form class="kt-form kt-form--label-right" >
            @csrf
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-bus">
                    </i>
                    &nbsp;
                    تصدير تقارير
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <div class="card-body">


{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="invoice_number" class="col-sm-2 col-form-label">رقم الفاتورة</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="text" class="form-control form-control-solid text-right" id="invoice_number"--}}
{{--                                   placeholder="رقم الفاتورة" name="invoice_number"--}}
{{--                                   v-model="invoice_number" autocomplete="off" aria-autocomplete="off">--}}
{{--                            <span--}}
{{--                                v-if="form.error && form.validations.invoice_number"--}}
{{--                                class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.invoice_number[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row mb-3">
                        <label for="name1" class="col-sm-2 col-form-label">الزبون</label>
                        <div class="col-sm-10">
                            <multiselect v-model="customer"
                                         :options="customersList"
                                         :searchable="true"
                                         :close-on-select="true"
                                         :show-labels="true"
                                         :custom-label="customerLabel"
                                         track-by="id"
                                         name="customer"
                                         :value="customer"
                                         @input="customer"
                                         placeholder="اختر الزبون">
                            </multiselect>
                        </div>
                    </div>


{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="vehicles_count" class="col-sm-2 col-form-label">عدد الحافلات</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="number" class="form-control form-control-solid text-right" id="vehicles_count"--}}
{{--                                   placeholder="عدد الحافلات " name="vehicles_count"--}}

{{--                                   v-model="vehicles_count" autocomplete="off" aria-autocomplete="off">--}}
{{--                            <span--}}
{{--                                v-if="form.error && form.validations.vehicles_count"--}}
{{--                                class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.vehicles_count[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <div class="form-group row mb-3">
                        <label for="date" class="col-sm-2 col-form-label">تاريخ الرحلة </label>
                        <div class="col-sm-10">



                            <el-date-picker

                                v-model="custom_period"
                                type="daterange"
                                align="right"
                                unlink-panels
                                range-separator="To"
                                start-placeholder="Start date"
                                end-placeholder="End date"
                                value-format="yyyy-MM-dd"
                            >
                            </el-date-picker>

                            <span
                                v-if="form.error && form.validations.date"
                                class="help-block invalid-feedback">
                              @{{ form.validations.date[0] }}
                        </span>
                        </div>
                    </div>


{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="price" class="col-sm-2 col-form-label">السعر (شيكل) </label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="number" class="form-control form-control-solid text-right" id="price"--}}
{{--                                   placeholder="السعر" name="price" v-model="price" >--}}
{{--                            <span v-if="form.error && form.validations.price"--}}
{{--                                  class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.price[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="prepaid_price" class="col-sm-2 col-form-label">دفعة (شيكل) </label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="number" class="form-control form-control-solid text-right" id="prepaid_price"--}}
{{--                                   placeholder="دفعة" name="prepaid_price" v-model="prepaid_price" >--}}
{{--                            <span v-if="form.error && form.validations.prepaid_price"--}}
{{--                                  class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.prepaid_price[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="remaining_price" class="col-sm-2 col-form-label">المبلغ المتبقي (شيكل) </label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <input type="number" class="form-control form-control-solid text-right" id="remaining_price"--}}
{{--                                   placeholder="المتبقي" name="remaining_price" v-model="remaining_price" >--}}
{{--                            <span v-if="form.error && form.validations.remaining_price"--}}
{{--                                  class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.remaining_price[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                <div class="form-group row mb-3">
                    <label for="going_vehicle_id" class="col-2 col-form-label">السائق  </label>
                    <div class="col-10">
                        <multiselect v-model="driver_id"
                                     :options="driversList"
                                     :searchable="true"
                                     :close-on-select="true"
                                     :show-labels="true"
                                     label="name"
                                     track-by="id"
                                     placeholder="اختر السائق  ">
                        </multiselect>



                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="going_vehicle_id" class="col-2 col-form-label">الباص  </label>
                    <div class="col-10">
                        <multiselect v-model="vehicle_id"
                                     :options="vehicleList"
                                     :searchable="true"
                                     :close-on-select="true"
                                     :show-labels="true"
                                     label="vehicle_number"
                                     track-by="id"
                                     placeholder="اختر الباص ">
                        </multiselect>



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

                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success active" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="payment_type"  checked="checked" value="" v-model="payment_type" />
                                        <!--end::Input-->
                                        الكل
                                    </label>

                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="payment_type"   value="cash" v-model="payment_type" />
                                        <!--end::Input-->
                                        كاش
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="payment_type"  value="cheque" v-model="payment_type"  />
                                        <!--end::Input-->
                                        شيك
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="payment_type" value="bank"  v-model="payment_type"/>
                                        <!--end::Input-->
                                        حوالة بنكية
                                    </label>
                                    <!--end::Radio-->

                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                    </div>



{{--                    <div class="form-group row mb-3">--}}
{{--                        <label for="agent" class="col-sm-2 col-form-label">المندوب</label>--}}
{{--                        <div class="col-sm-10">--}}
{{--                            <multiselect v-model="agent"--}}
{{--                                         :options="agentsList"--}}
{{--                                         :searchable="true"--}}
{{--                                         :close-on-select="true"--}}
{{--                                         :show-labels="true"--}}
{{--                                         label="name"--}}
{{--                                         track-by="id"--}}
{{--                                         placeholder="اختر المندوب">--}}
{{--                            </multiselect>--}}

{{--                            <span v-if="form.error && form.validations.agent"--}}
{{--                                  class="help-block invalid-feedback">--}}
{{--                              @{{ form.validations.agent[0] }}--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}




            </div>
            <div class="card-footer">

                <button type="button"  class="btn  btn-success" @click="handleDownlaod">
                    فلترة وتصدير
                </button>

                <a :href="'/admin/reports/export-excel-file'"
                   target="_blank" class="btn  btn-success" >
                  تصدير الكل
                </a>


                <a href="{{route('admin.home')}}" class="btn btn-secondary">
                    إلغاء الأمر
                </a>
            </div>

        </div>
        </form>
    </trip-export>
@endsection
