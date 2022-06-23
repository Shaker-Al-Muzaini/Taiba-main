@extends('admin.layouts.app')

@push('css')

@endpush
@section('content')

    <drivers-list :fetch-data-url="'{{route('admin.mange.drivers.search')}}'"
                    :role="'admin'"
                    inline-template>
        <div>


            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">إدارة السائقين</h3>
                    <div class="card-toolbar">
                        <button type="button" @click="innerVisible = true" class="btn  btn-sm btn-primary">
                            <i class="flaticon2-add-1"></i>
                            إضافة سائق جديد
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
                        {{--  :sort-order="name_en"--}}
                        ref="adminTable"
                    >

                        <table-column label="#" :sortable="false" :filterable="false">
                            <template scope="user">
                                @{{((currentPage-1) * per_page)+ data.indexOf(user)+1}}
                            </template>
                        </table-column>
                        {{--                                <table-column label="رقم التسجيل" show="reg_no"></table-column>--}}
                        <table-column label="اسم السائق" :sortable="false" :filterable="false">
                            <template scope="user">
                                <div class="kt-widget-4">
                                    <div class="kt-widget-4__item">
                                        <div class="kt-widget-4__item-content">
                                            <div class="kt-widget-4__item-section">
                                                {{--                                                        <div class="kt-widget-4__item-pic">--}}
                                                {{--                                                            <img class=""  :src="user.avatar_url"  alt="Avatar">--}}
                                                {{--                                                        </div>--}}
                                                <div class="kt-widget-4__item-info">
                                                    <a href="#"
                                                       class="kt-widget-4__item-username">
                                                        @{{ user.name }}
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </table-column>
                        {{----}}
                        <table-column label="رقم الجوال" show="mobile"></table-column>
                        <table-column label="المنطقة" show="state_name"></table-column>
                        <table-column label="حالة السائق" show="type_status_label"></table-column>
                        <table-column label="تاريخ الإضافة" :sortable="false" :filterable="false">
                            <template scope="user">
                                @{{dataFormatter(user.created_at)}}
                            </template>
                        </table-column>
                        <table-column label="الاجراءات" :sortable="false" :filterable="false">
                            <template scope="user">

                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                   href="javascript:;" @click="handelViewUser(user)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>

                                {{--                                        @can('admin.edit')--}}
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                   href="javascript:;" @click="handelEditUser(user)">
                                    <i class="fa fa-user-edit" aria-hidden="true"></i>
                                </a>
                                {{--                                        @endcan--}}


                                        <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                           @click="deleteAction('/admin/drivers/destroy/',user.id,true)" href="javascript:;">
                                            <i class="fa fa-trash-alt" aria-hidden="true" style="color:red;"></i>
                                        </a>
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
                :title="id?'تعديل بيانات سائق':'إضافة سائق جديد'"
                :visible.sync="innerVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>


                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-2 col-form-label">اسم السائق</label>
                            <div class="col-sm-10">
                                <input type="text"  class=" form-control form-control-solid" id="name1"
                                       placeholder="اسم السائق" name="name"
                                       v-model="name">
                                <span v-if="form.error && form.validations.name"
                                      class="help-block invalid-feedback">@{{ form.validations.name[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="mobile" class="col-sm-2 col-form-label">رقم الجوال</label>
                            <div class="col-sm-10">
                                <input type="text"  class=" form-control form-control-solid" id="mobile"
                                       placeholder="الجوال" name="mobile"
                                       v-model="mobile" @keydown="onlyNumberKey(this)">
                                <span v-if="form.error && form.validations.mobile"
                                      class="help-block invalid-feedback">@{{ form.validations.mobile[0] }}</span>
                            </div>
                        </div>



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
                            <label for="payment_type" class="col-sm-2 col-form-label">
                                حالة السائق
                            </label>
                            <div class="col-sm-10">

                                <div class="fv-row">
                                    <!--begin::Radio group-->
                                    <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <!--begin::Radio-->
                                        <label for="daily" class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="type_status=='daily'?'active':''"  data-kt-button="true">
                                            <!--begin::Input-->
                                            <input class="btn-check"  id="daily" type="radio" name="type_status"  :checked="type_status=='daily'?'checked':''" value="daily" v-model="type_status" />
                                            <!--end::Input-->
                                            يومي
                                        </label>
                                        <!--end::Radio-->
                                        <!--begin::Radio-->
                                        <label for="new_daily" class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="type_status=='new_daily'?'active':''"
                                             data-kt-button="true">
                                            <!--begin::Input-->
                                            <input class="btn-check" id="new_daily" type="radio" name="type_status"  :checked="type_status=='new_daily'?'checked':''" value="new_daily" v-model="type_status"  />
                                            <!--end::Input-->
                                            يومي جديد
                                        </label>
                                        <!--end::Radio-->
                                        <!--begin::Radio-->
                                        <label  for="vaction" class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success " :class="type_status=='vacation'?'active':''"   data-kt-button="true">
                                            <!--begin::Input-->
                                            <input class="btn-check" id="vaction" type="radio" name="type_status"  :checked="type_status=='vacation'?'checked':''" value="vacation" v-model="type_status"  />
                                            <!--end::Input-->
                                            اجازة
                                        </label>

                                    </div>
                                    <!--end::Radio group-->
                                </div>
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

            <el-dialog

                @closed="clearModelData"
                width="40%"
                :title="'عرض بيانات السائق'"
                :visible.sync="innerViewVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>

                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>اسم السائق</th>
                                <td>@{{ name }}</td>
                            </tr>
                            <tr>
                                <th>رقم الجوال</th>
                                <td>@{{ mobile }}</td>
                            </tr>

                            <tr>
                                <th>المنطقة</th>
                                <td>@{{ state?state.name:'' }}</td>
                            </tr>

                            {{--                            <tr>--}}
                            {{--                                <th>العنوان</th>--}}
                            {{--                                <td>@{{ address }}</td>--}}
                            {{--                            </tr>--}}
                            </tbody>
                        </table>
                    </div>
                </form>
                <div slot="footer" class="dialog-footer" v-if="!id">
                    <el-button class="btn btn-primary" class="addUser" @click="addUser"
                               :disabled="form.disabled">إضافة</el-button>
                    <el-button @click="innerViewVisible = false">إلغاء الأمر</el-button>
                    {{--                <el-button type="primary" @click="innerVisible = true">open the inner Dialog</el-button>--}}
                </div>

            </el-dialog>
        </div>

    </customers-list>


@endsection
