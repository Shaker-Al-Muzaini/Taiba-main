@extends('admin.layouts.app')

@push('css')

@endpush
@section('content')

    <vehicle-list :fetch-data-url="'{{route('admin.mange.vehicles.search')}}'"
                    inline-template>
        <div>


            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">بيانات الحافلات </h3>
                    <div class="card-toolbar">
                        <button type="button" @click="innerVisible = true" class="btn  btn-sm btn-primary">
                            <i class="flaticon2-add-1"></i>
                            إضافة حافلة جديدة
                        </button>
                    </div>
                </div>
                <div class="card-body" style="overflow-x: scroll">
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
                            <template scope="user">
                                @{{((currentPage-1) * per_page)+ data.indexOf(user)+1}}
                            </template>
                        </table-column>

                        <table-column label="رقم الحافلة" show="vehicle_number"></table-column>
                        <table-column label="رقم لوحة الحافلة" show="licence_number"></table-column>
                        <table-column label="رقم الشاصي" show="chassis_number"></table-column>
                        <table-column label="نوع الحافلة" show="type"></table-column>
                        <table-column label="لون الحافلة" show="color"></table-column>
                        <table-column label="عدد المقاعد" show="capacity"></table-column>
                        <table-column label="تاريخ الإنتاج" show="production_date"></table-column>
                        <table-column label="تاريخ انتهاء الرخصة" show="licence_expire_date"></table-column>
                        <table-column label="تاريخ انتهاء التأمين" show="insurance_expire_date"></table-column>
                        <table-column label="الاجراءات" :sortable="false" :filterable="false">
                            <template scope="user">

{{--                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"--}}
{{--                                   href="javascript:;" @click="handelViewUser(user)">--}}
{{--                                    <i class="fa fa-eye" aria-hidden="true"></i>--}}
{{--                                </a>--}}

                                {{--                                        @can('admin.edit')--}}
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                   href="javascript:;" @click="handelEditUser(user)">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                {{--                                        @endcan--}}


{{--                            <a class="btn btn-sm btn-clean btn-icon btn-icon-md"--}}
{{--                               @click="deleteAction('/admin/vehicles/destroy/',user.id,true)" href="javascript:;">--}}
{{--                                <i class="fa fa-trash-alt" aria-hidden="true" style="color:red;"></i>--}}
{{--                            </a>--}}
                            </template>
                        </table-column>
                    </table-component>
                </div>
                {{--        <div class="card-footer">--}}
                {{--            Footer--}}
                {{--        </div>--}}
            </div>
            <el-dialog

                @closed="clearModelData"
                width="40%"
                :title="id?'تعديل بيانات الحافلة':'إضافة حافلة جديدة'"
                :visible.sync="innerVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>








                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">رقم الحافلة</label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="vehicle_number"
                                       placeholder="رقم الحافلة" name="vehicle_number"
                                       v-model="vehicle_number">
                                <span v-if="form.error && form.validations.vehicle_number"
                                      class="help-block invalid-feedback">@{{ form.validations.vehicle_number[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">رقم اللوحة</label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="licence_number"
                                       placeholder="رقم اللوحة " name="licence_number"
                                       v-model="licence_number">
                                <span v-if="form.error && form.validations.licence_number"
                                      class="help-block invalid-feedback">@{{ form.validations.licence_number[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">رقم الشاصي</label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="chassis_number"
                                       placeholder="رقم الشاصي" name="chassis_number"
                                       v-model="chassis_number">
                                <span v-if="form.error && form.validations.chassis_number"
                                      class="help-block invalid-feedback">@{{ form.validations.chassis_number[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">نوع الحافلة </label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="type"
                                       placeholder="نوع الحافلة " name="type"
                                       v-model="type">
                                <span v-if="form.error && form.validations.type"
                                      class="help-block invalid-feedback">@{{ form.validations.type[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">لون الحافلة </label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="color"
                                       placeholder="لون الحافلة " name="color"
                                       v-model="color">
                                <span v-if="form.error && form.validations.color"
                                      class="help-block invalid-feedback">@{{ form.validations.color[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">عدد المقاعد </label>
                            <div class="col-sm-9">
                                <input type="text"  class=" form-control form-control-solid" id="capacity"
                                       placeholder="عدد المقاعد " name="capacity"
                                       v-model="capacity">
                                <span v-if="form.error && form.validations.capacity"
                                      class="help-block invalid-feedback">@{{ form.validations.capacity[0] }}
                                </span>
                            </div>
                        </div>


                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">تاريخ الانتاج </label>
                            <div class="col-sm-9">

                                <el-date-picker
                                    v-model="production_date"
                                    type="date"
                                    placeholder="تاريخ الانتاج ">
                                </el-date-picker>

                                <span v-if="form.error && form.validations.production_date"
                                      class="help-block invalid-feedback">@{{ form.validations.production_date[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">تاريخ انتهاء الرخصة </label>
                            <div class="col-sm-9">

                                <el-date-picker
                                    v-model="licence_expire_date"
                                    type="date"
                                    placeholder="تاريخ انتهاء الرخصة">
                                </el-date-picker>

                                <span v-if="form.error && form.validations.licence_expire_date"
                                      class="help-block invalid-feedback">@{{ form.validations.licence_expire_date[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-3 col-form-label">تاريخ انتهاء التأمين </label>
                            <div class="col-sm-9">
                                <el-date-picker
                                   v-model="insurance_expire_date"
                                    type="date"
                                    placeholder="تاريخ انتهاء التأمين">
                                </el-date-picker>
                                <span v-if="form.error && form.validations.insurance_expire_date"
                                      class="help-block invalid-feedback">@{{ form.validations.insurance_expire_date[0] }}
                                </span>
                            </div>
                        </div>

                    </div>


                </form>
                <div slot="footer" class="dialog-footer" v-if="!id">
                    <el-button class="btn btn-primary" class="addUser" @click="addUser"
                               :disabled="form.disabled">حفظ</el-button>
                    <el-button @click="innerVisible = false">إلغاء الأمر</el-button>
                    {{--                <el-button type="primary" @click="innerVisible = true">open the inner Dialog</el-button>--}}
                </div>
                <div slot="footer" class="dialog-footer" v-if="id">
                    <el-button class="btn btn-primary" class="updateUser" @click="addUser">تحديث</el-button>
                    <el-button @click="innerVisible = false">إلغاء الأمر</el-button>
                    {{--                <el-button type="primary" @click="innerVisible = true">open the inner Dialog</el-button>--}}
                </div>
            </el-dialog>

{{--            <el-dialog--}}

{{--                @closed="clearModelData"--}}
{{--                width="40%"--}}
{{--                :title="'عرض بيانات الحافلة'"--}}
{{--                :visible.sync="innerViewVisible"--}}
{{--                :close-on-click-modal="false"--}}
{{--                append-to-body>--}}
{{--                <form class="kt-form kt-form--label-right">--}}
{{--                    <div>--}}

{{--                        <table class="table table-striped">--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <th>الاسم</th>--}}
{{--                                <td>@{{ name }}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <th>رقم الجوال</th>--}}
{{--                                <td>@{{ mobile }}</td>--}}
{{--                            </tr>--}}

{{--                            <tr>--}}
{{--                                <th>الإيميل</th>--}}
{{--                                <td>@{{ email }}</td>--}}
{{--                            </tr>--}}

{{--                            --}}{{--                            <tr>--}}
{{--                            --}}{{--                                <th>العنوان</th>--}}
{{--                            --}}{{--                                <td>@{{ address }}</td>--}}
{{--                            --}}{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--                <div slot="footer" class="dialog-footer" v-if="!id">--}}
{{--                    <el-button class="btn btn-primary" class="addUser" @click="addUser"--}}
{{--                               :disabled="form.disabled">إضافة</el-button>--}}
{{--                    <el-button @click="innerViewVisible = false">إلغاء الأمر</el-button>--}}
{{--                    --}}{{--                <el-button type="primary" @click="innerVisible = true">open the inner Dialog</el-button>--}}
{{--                </div>--}}

{{--            </el-dialog>--}}
        </div>

    </vehicle-list>


@endsection
