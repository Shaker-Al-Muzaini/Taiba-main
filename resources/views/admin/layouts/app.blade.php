<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <title> شركة إيلياء الطيبة </title>
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="شركة ايلياء الطيبة" />
    <meta property="og:url" content="https://bbbbbbb.com" />
    <meta property="og:site_name" content="شركة الياء الطيبة" />
    <link rel="canonical" href="" />
{{--    <link rel="shortcut icon" href="{{asset('admin/media/logos/favicon.ico')}}" />--}}
    <!--begin::Fonts-->

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />--}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
{{--    <link href="{{asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />--}}
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{asset('admin/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        @font-face {
            font-family: MyFont;
            src: url({{asset('admin/plugins/global/fonts/Cairo-Regular.ttf')}});
        }

        body{
            /*font-family: 'Roboto', sans-serif !important;*/
            font-family: MyFont !important;
        }

    </style>

    <style scoped>

        .el-dialog__headerbtn,.el-notification__closeBtn{
            right: auto !important;
            left: 20px !important;
            top:13px;
            font-size: 25px;
        }
        .notification-badge{
            position: absolute;
            top: 1px;
            border-radius: 50%;
            right: 4px;
        }
        .icon-container{
            margin-top: 25%;
        }
        .image-preview-block{
            margin: 5px;
            position: relative;
            width: 90px ;
            height: 80px;
        }

        .add-new-image-block{
            cursor:pointer;
            margin: 5px;
            width: 90px;
            height: 90px;
            border: 2px dashed;
            border-color: darkgray;
            text-align: center;
            vertical-align: middle;
        }
        .image-upload > input {
            display: none;
        }
        .fa-camera{
            cursor: pointer;
        }

        /*.image-upload img {*/
        /*    width: 120px;*/
        /*    cursor: pointer;*/
        /*}*/

        .rmove-icon {
            position: absolute;
            display: block;
            top: 7px;
            right: 7px;
            cursor: pointer;
            font-size:18px !important;
            color:red;
        }

        .review-img {
            width: 90px;
            height: 90px;
            /*min-height: 250px ;*/
            /*margin-bottom: 15px;*/
        }

        .review-img-t {
            width: 350px !important;
            width: 250px !important;
        }

    </style>
    <style>
        [v-cloak] > * { display:none }
        [v-cloak]::before { content: "loading…" }
        .vue-star-rating-star{
            width:25px !important;
            height: 25px !important;
        }
        .table td, .table th{
            vertical-align: middle !important;
        }
        .invalid-feedback{
            display: block !important;
        }
        .page-item a{
            cursor: pointer;
        }
        .pagination a{
            cursor: pointer;
            width: 20px;
            height: 30px;
            margin-left: 2px;
            margin-right: 2px;
            text-align: center;
            vertical-align: middle;
            display: table-cell;
            border: 1px solid whitesmoke;
        }



        .loading {
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 100;
            background: rgba(0, 0, 0, 0.24);
            top: 0;
        }

        .loading i {
            display: block !important;
            margin: 22% auto;
            font-size: 100px;
            color: #36c6d3;
        }
        .clear-image {
            border: 1px solid darkgray;
            text-align: center;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: auto;
            right: -10px;
            bottom: -5px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background-color: #fff;
            box-shadow: 0 0 13px 0 rgba(0, 0, 0, .1);
        }
            #kt_header_nav{
                    align-items: center !important;
            }
    </style>

    @stack('css')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed"
      dir="rtl" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="{{route('admin.home')}}">
{{--                    <img alt="Logo" src="{{asset('admin/media/logos/logo-1-dark.svg')}}" class="h-25px logo" />--}}
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg')}}-->
                    <span class="svg-icon svg-icon-1 rotate-180">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="black" />
									<path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="black" />
								</svg>
							</span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Aside toggler-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside menu-->
                    @include('admin.layouts.partials.aside')
            <!--end::Aside menu-->
            <!--begin::Footer-->

            <!--end::Footer-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" style="" class="header align-items-stretch">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Aside mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg')}}-->
                            <span class="svg-icon svg-icon-2x mt-1">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
											<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
											<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
										</svg>
									</span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Aside mobile toggle-->
                    <!--begin::Mobile logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                        <a href="javascript:;" class="d-lg-none">
                            <img alt="Logo" src="{{asset('uploads/tyba_logo.jpeg')}}" class="h-30px" />
                        </a>
                    </div>
                    <!--end::Mobile logo-->
                    <!--begin::Wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <!--begin::Navbar-->
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                            <img alt="Logo" src="{{asset('uploads/tyba_logo.jpeg')}}" class="h-50px" />
                            <h3 class="p-3">شركة إيلياء الطيبة للنقل والسياحة</h3>
                        </div>
                        <!--end::Navbar-->
                        <!--begin::Topbar-->
                        <div class="d-flex align-items-stretch flex-shrink-0">
                            <!--begin::Toolbar wrapper-->
                            <div class="d-flex align-items-stretch flex-shrink-0">


{{--                                <!--begin::Quick links-->--}}
{{--                                <div class="d-flex align-items-center ms-1 ms-lg-3">--}}
{{--                                    <!--begin::Menu wrapper-->--}}
{{--                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">--}}
{{--                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg')}}-->--}}
{{--                                        <span class="svg-icon svg-icon-1">--}}
{{--													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--														<rect x="2" y="2" width="9" height="9" rx="2" fill="black" />--}}
{{--														<rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />--}}
{{--														<rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />--}}
{{--														<rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />--}}
{{--													</svg>--}}
{{--												</span>--}}
{{--                                        <!--end::Svg Icon-->--}}
{{--                                    </div>--}}
{{--                                    <!--begin::Menu-->--}}
{{--                                    <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">--}}
{{--                                        <!--begin::Heading-->--}}
{{--                                        <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('{{asset('admin/media/misc/pattern-1.jpg')}}')">--}}
{{--                                            <!--begin::Title-->--}}
{{--                                            <h3 class="text-white fw-bold mb-3">Quick Links</h3>--}}
{{--                                            <!--end::Title-->--}}
{{--                                            <!--begin::Status-->--}}
{{--                                            <span class="badge bg-primary py-2 px-3">25 pending tasks</span>--}}
{{--                                            <!--end::Status-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Heading-->--}}
{{--                                        <!--begin:Nav-->--}}
{{--                                        <div class="row g-0">--}}
{{--                                            <!--begin:Item-->--}}
{{--                                            <div class="col-6">--}}
{{--                                                <a href="../../demo1/dist/pages/projects/budget.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">--}}
{{--                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg')}}-->--}}
{{--                                                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																	<path opacity="0.3" d="M15.8 11.4H6C5.4 11.4 5 11 5 10.4C5 9.80002 5.4 9.40002 6 9.40002H15.8C16.4 9.40002 16.8 9.80002 16.8 10.4C16.8 11 16.3 11.4 15.8 11.4ZM15.7 13.7999C15.7 13.1999 15.3 12.7999 14.7 12.7999H6C5.4 12.7999 5 13.1999 5 13.7999C5 14.3999 5.4 14.7999 6 14.7999H14.8C15.3 14.7999 15.7 14.2999 15.7 13.7999Z" fill="black" />--}}
{{--																	<path d="M18.8 15.5C18.9 15.7 19 15.9 19.1 16.1C19.2 16.7 18.7 17.2 18.4 17.6C17.9 18.1 17.3 18.4999 16.6 18.7999C15.9 19.0999 15 19.2999 14.1 19.2999C13.4 19.2999 12.7 19.2 12.1 19.1C11.5 19 11 18.7 10.5 18.5C10 18.2 9.60001 17.7999 9.20001 17.2999C8.80001 16.8999 8.49999 16.3999 8.29999 15.7999C8.09999 15.1999 7.80001 14.7 7.70001 14.1C7.60001 13.5 7.5 12.8 7.5 12.2C7.5 11.1 7.7 10.1 8 9.19995C8.3 8.29995 8.79999 7.60002 9.39999 6.90002C9.99999 6.30002 10.7 5.8 11.5 5.5C12.3 5.2 13.2 5 14.1 5C15.2 5 16.2 5.19995 17.1 5.69995C17.8 6.09995 18.7 6.6 18.8 7.5C18.8 7.9 18.6 8.29998 18.3 8.59998C18.2 8.69998 18.1 8.69993 18 8.79993C17.7 8.89993 17.4 8.79995 17.2 8.69995C16.7 8.49995 16.5 7.99995 16 7.69995C15.5 7.39995 14.9 7.19995 14.2 7.19995C13.1 7.19995 12.1 7.6 11.5 8.5C10.9 9.4 10.5 10.6 10.5 12.2C10.5 13.3 10.7 14.2 11 14.9C11.3 15.6 11.7 16.1 12.3 16.5C12.9 16.9 13.5 17 14.2 17C15 17 15.7 16.8 16.2 16.4C16.8 16 17.2 15.2 17.9 15.1C18 15 18.5 15.2 18.8 15.5Z" fill="black" />--}}
{{--																</svg>--}}
{{--															</span>--}}
{{--                                                    <!--end::Svg Icon-->--}}
{{--                                                    <span class="fs-5 fw-bold text-gray-800 mb-0">Accounting</span>--}}
{{--                                                    <span class="fs-7 text-gray-400">eCommerce</span>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <!--end:Item-->--}}
{{--                                            <!--begin:Item-->--}}
{{--                                            <div class="col-6">--}}
{{--                                                <a href="../../demo1/dist/pages/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">--}}
{{--                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg')}}-->--}}
{{--                                                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																	<path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />--}}
{{--																	<path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />--}}
{{--																</svg>--}}
{{--															</span>--}}
{{--                                                    <!--end::Svg Icon-->--}}
{{--                                                    <span class="fs-5 fw-bold text-gray-800 mb-0">Administration</span>--}}
{{--                                                    <span class="fs-7 text-gray-400">Console</span>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <!--end:Item-->--}}
{{--                                            <!--begin:Item-->--}}
{{--                                            <div class="col-6">--}}
{{--                                                <a href="../../demo1/dist/pages/projects/list.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">--}}
{{--                                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg')}}-->--}}
{{--                                                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																	<path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="black" />--}}
{{--																	<path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="black" />--}}
{{--																</svg>--}}
{{--															</span>--}}
{{--                                                    <!--end::Svg Icon-->--}}
{{--                                                    <span class="fs-5 fw-bold text-gray-800 mb-0">Projects</span>--}}
{{--                                                    <span class="fs-7 text-gray-400">Pending Tasks</span>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <!--end:Item-->--}}
{{--                                            <!--begin:Item-->--}}
{{--                                            <div class="col-6">--}}
{{--                                                <a href="../../demo1/dist/pages/projects/users.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">--}}
{{--                                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg')}}-->--}}
{{--                                                    <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--																	<path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />--}}
{{--																	<path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />--}}
{{--																</svg>--}}
{{--															</span>--}}
{{--                                                    <!--end::Svg Icon-->--}}
{{--                                                    <span class="fs-5 fw-bold text-gray-800 mb-0">Customers</span>--}}
{{--                                                    <span class="fs-7 text-gray-400">Latest cases</span>--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                            <!--end:Item-->--}}
{{--                                        </div>--}}
{{--                                        <!--end:Nav-->--}}
{{--                                        <!--begin::View more-->--}}
{{--                                        <div class="py-2 text-center border-top">--}}
{{--                                            <a href="../../demo1/dist/pages/profile/activity.html" class="btn btn-color-gray-600 btn-active-color-primary">View All--}}
{{--                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg')}}-->--}}
{{--                                                <span class="svg-icon svg-icon-5">--}}
{{--														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--															<rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />--}}
{{--															<path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />--}}
{{--														</svg>--}}
{{--													</span>--}}
{{--                                                <!--end::Svg Icon--></a>--}}
{{--                                        </div>--}}
{{--                                        <!--end::View more-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Menu-->--}}
{{--                                    <!--end::Menu wrapper-->--}}
{{--                                </div>--}}
{{--                                <!--end::Quick links-->--}}
                                <!--begin::User-->
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <!--begin::Menu wrapper-->
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <img src="{{auth('admin')->user()->avatar_url}}" alt="user" />
                                    </div>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="{{auth('admin')->user()->avatar_url}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">{{auth('admin')->user()->name}}
                                                        <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">آدمين</span></div>
                                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{auth('admin')->user()->email}}</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->



                                        <!--begin::Menu item-->
{{--                                        <div class="menu-item px-5">--}}
{{--                                            <a href="../../demo1/dist/account/statements.html" class="menu-link px-5">My Statements</a>--}}
{{--                                        </div>--}}
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->


                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">


                                            <a class="menu-link px-5" href="{{ route('admin.logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                               تسجيل خروج
                                            </a>

                                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                        </div>
                                        <!--end::Menu item-->

                                    </div>
                                    <!--end::Menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::User -->
                                <!--begin::Heaeder menu toggle-->
                                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_header_menu_mobile_toggle">
                                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg')}}-->
                                        <span class="svg-icon svg-icon-1">
													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
														<path d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z" fill="black" />
														<path opacity="0.3" d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z" fill="black" />
													</svg>
												</span>
                                        <!--end::Svg Icon-->
                                    </div>
                                </div>
                                <!--end::Heaeder menu toggle-->
                            </div>
                            <!--end::Toolbar wrapper-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Header-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <div id="my-app" v-cloak>
                             @yield('content')
                        </div>

                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->
            @include('admin.layouts.partials.footer')
            <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Drawers-->



<!--end::Drawers-->
<!--begin::Modals-->

<!--end::Modals-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg')}}-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
					<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->
<!--end::Main-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('admin/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('admin/js/custom/widgets.js')}}"></script>
<script src="{{asset('admin/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('admin/js/custom/modals/create-app.js')}}"></script>
<script src="{{asset('admin/js/custom/modals/upgrade-plan.js')}}"></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
@stack('js')
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
<!--end::Body-->
</html>
