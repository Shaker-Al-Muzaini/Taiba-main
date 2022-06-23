@extends('admin.layouts.app')

@push('css')

@endpush
@section('content')

    <state-list :fetch-data-url="'{{route('admin.mange.states.search')}}'"
                    :role="'admin'"
                    inline-template>
        <div>


            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">إدارة المناطق</h3>
                    <div class="card-toolbar">
                        <button type="button" @click="innerVisible = true" class="btn  btn-sm btn-primary">
                            <i class="flaticon2-add-1"></i>
                            إضافة منطقة جديدة
                        </button>
                    </div>
                </div>
                <div class="card-body">
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

                        <table-column label="اسم المنطقة" show="name"></table-column>

                        <table-column label="تاريخ الإضافة" :sortable="false" :filterable="false">
                            <template scope="user">
                                @{{dataFormatter(user.created_at)}}
                            </template>
                        </table-column>
                        <table-column label="الاجراءات" :sortable="false" :filterable="false">
                            <template scope="user">



                                {{--    @can('admin.edit')--}}
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                   href="javascript:;" @click="handelEditUser(user)">
                                    <i class="fa fa-user-edit" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-sm btn-clean btn-icon btn-icon-md"
                                   @click="deleteAction('/admin/states/destroy/',user.id,true)" href="javascript:;">
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
                :title="id?'تعديل بيانات المنطقة':'إضافة منطقة جديدة'"
                :visible.sync="innerVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>


                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-2 col-form-label">اسم المنطقة</label>
                            <div class="col-sm-10">
                                <input type="text"  class=" form-control form-control-solid" id="name1"
                                       placeholder="الاسم" name="name"
                                       v-model="name">
                                <span v-if="form.error && form.validations.name"
                                      class="help-block invalid-feedback">@{{ form.validations.name[0] }}
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

            <el-dialog

                @closed="clearModelData"
                width="40%"
                :title="'عرض بيانات الزبون'"
                :visible.sync="innerViewVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>

                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>الاسم</th>
                                <td>@{{ name }}</td>
                            </tr>
                            <tr>
                                <th>رقم الجوال</th>
                                <td>@{{ mobile }}</td>
                            </tr>

                            <tr>
                                <th>الإيميل</th>
                                <td>@{{ email }}</td>
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

    </state-list>


@endsection
