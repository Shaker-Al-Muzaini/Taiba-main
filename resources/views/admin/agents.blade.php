@extends('admin.layouts.app')

@push('css')

@endpush
@section('content')

    <agents-list :fetch-data-url="'{{route('admin.mange.agent.search')}}'"
                 :role="'admin'"
                 inline-template>
        <div>


            <div class="card shadow-sm">
                <div class="card-header">
                    <h3 class="card-title">مسؤولي المناطق</h3>
                    <div class="card-toolbar">
                        <button type="button" @click="innerVisible = true" class="btn  btn-sm btn-primary">
                            <i class="flaticon2-add-1"></i>
                            إضافة مسؤول منطقة جديد
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
                        {{--                                <table-column label="رقم التسجيل" show="reg_no"></table-column>--}}
                        <table-column label="اسم مسؤول المنطقة" :sortable="false" :filterable="false">
                            <template scope="user">
                                <div class="kt-widget-4">
                                    <div class="kt-widget-4__item">
                                        <div class="kt-widget-4__item-content">
                                            <div class="kt-widget-4__item-section">
                                            <div class="kt-widget-4__item-pic">

                                            </div>
                                                <div class="kt-widget-4__item-info">
                                                    <img class=""  :src="user.avatar_url"  alt="Avatar" width="50" height="50" style="border-radius: 50%;margin-left: 4px;margin-right: 4px">
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
                        <table-column label="الايميل" show="email"></table-column>
                        <table-column label="رقم الجوال" show="mobile"></table-column>
                        <table-column label="المنطقة" show="state_name"></table-column>
                        <table-column label="الحالة ">
                            <template scope="user">
                                {{--                                        @can('admin.disable')--}}
                                <toggle-button
                                    :value="user.active==1?true:false"
                                    color="#82C7EB"
                                    :sync="true"
                                    @change="onChangeEventToggleHandler($event,'{!! route('admin.mange.agent.change.status') !!}',user.id)"
                                />
                                {{--                                        @endcan--}}
                            </template>
                        </table-column>

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
                                   @click="deleteAction('/admin/agents/destroy/',user.id,true)" href="javascript:;">
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
                :title="id?'تعديل بيانات مسؤول منطقة':'إضافة مسؤول جديد'"
                :visible.sync="innerVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>
                        <div class="col-12 text-center">
                            {{--                                        <label for="example-text-input" class="col-4 col-form-label">Logo</label>--}}


                            <div class="kt-avatar kt-avatar--outline kt-avatar--success"
                                 id="kt_profile_avatar_3">
                                <div class="kt-avatar__holder"
                                >
                                    <img v-if='user_avatar' :src="user_avatar" alt="user avatar" style="    height: 114px;
    width: 114px;"/>
                                </div>
                                <label class="kt-avatar__upload" title="Change avatar">
                                    <i class="fa fa-pen"></i>
                                    <input type='file' name="logo" @change="onFileChange($event,'user_avatar')"
                                           accept=".png, .jpg, .jpeg"/>
                                </label>
                                <span class="clear-image" title="Cancel avatar" v-if="user_avatar && !id"
                                      @click.prevent="removeImage('user_avatar')">
                                            <i class="fa fa-times"></i>
                                </span>
                            </div>
                            <span v-if="form.error && form.validations.user_avatar"
                                  class="help-block invalid-feedback">@{{ form.validations.user_avatar[0] }}</span>
                        </div>
                        <br/>


                        <div class="form-group row mb-3">
                            <label for="name1" class="col-sm-2 col-form-label">الاسم</label>
                            <div class="col-sm-10">
                                <input type="text"  class=" form-control form-control-solid" id="name1"
                                       placeholder="الاسم" name="name"
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
                            <label for="email" class="col-sm-2 col-form-label">الإيميل</label>
                            <div class="col-sm-10">
                                <input type="email"  class=" form-control form-control-solid" id="email"
                                       placeholder="البريد الالكتروني" name="name"
                                       v-model="email"  autocomplete="off" aria-autocomplete="off">
                                <span v-if="form.error && form.validations.email"
                                      class="help-block invalid-feedback">
                                    @{{ form.validations.email[0] }}
                                </span>
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
                            <label for="password" class="col-sm-2 col-form-label">كلمة المرور</label>
                            <div class="col-sm-10">
                                <input type="password"  class="form-control form-control-solid" id="password"
                                       placeholder="كلمة المرور" name="name"
                                       v-model="password"  autocomplete="off" aria-autocomplete="off">
                                <span v-if="form.error && form.validations.password"
                                      class="help-block invalid-feedback">
                                    @{{ form.validations.password[0] }}
                                </span>
                                <span v-if="id"
                                      class="help-block invalid-feedback">
                                    إذا كنت لا تريد تغيير كلمة المرور اترك الحقل فارغاً </span>

                            </div>
                        </div>

                        {{--                        <div class="form-group row">--}}
                        {{--                            <label for="example-text-input" class="col-3 col-form-label">الدور</label>--}}
                        {{--                            <div class="col-9">--}}
                        {{--                                <select v-model="systemRoleId" class="form-control">--}}
                        {{--                                    <option v-for="role in systemsRoles" :value="role.id">--}}
                        {{--                                        @{{ role.name }}--}}
                        {{--                                    </option>--}}
                        {{--                                </select>--}}
                        {{--                                <span v-if="form.error && form.validations.systemRoleId"--}}
                        {{--                                      class="help-block invalid-feedback">@{{ form.validations.systemRoleId[0] }}--}}
                        {{--                                </span>--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group row">--}}
                        {{--                            <label for="example-text-input" class="col-3 col-form-label">العنوان</label>--}}
                        {{--                            <div class="col-9">--}}
                        {{--                                <input type="text" class="form-control" placeholder="العنوان"--}}
                        {{--                                       v-model="address">--}}
                        {{--                                <span v-if="form.error && form.validations.address"--}}
                        {{--                                      class="help-block invalid-feedback">@{{ form.validations.address[0] }}</span>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}



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
                :title="'عرض بيانات مسؤول المنطقة'"
                :visible.sync="innerViewVisible"
                :close-on-click-modal="false"
                append-to-body>
                <form class="kt-form kt-form--label-right">
                    <div>
                        <div class="col-12 text-center">
                            {{--                                        <label for="example-text-input" class="col-4 col-form-label">Logo</label>--}}


                            <div class="kt-avatar kt-avatar--outline kt-avatar--success"
                                 id="kt_profile_avatar_3">
                                <div class="kt-avatar__holder"
                                >
                                    <img v-if='user_avatar' :src="user_avatar" alt="user avatar" style="    height: 114px;
    width: 114px;"/>
                                </div>
                                {{--                                <label class="kt-avatar__upload" title="Change avatar">--}}
                                {{--                                    <i class="fa fa-pen"></i>--}}
                                {{--                                    <input type='file' name="logo" @change="onFileChange($event,'user_avatar')"--}}
                                {{--                                           accept=".png, .jpg, .jpeg"/>--}}
                                {{--                                </label>--}}

                            </div>

                        </div>
                        <br/>

                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th>الاسم</th>
                                <td>@{{ name }}</td>
                            </tr>
                            <tr>
                                <th>الإيميل</th>
                                <td>@{{ email }}</td>
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

    </agents-list>


@endsection
