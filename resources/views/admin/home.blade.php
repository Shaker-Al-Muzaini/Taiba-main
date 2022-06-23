@extends('admin.layouts.app')
@push('js')
    <script src="{{asset('admin/js/apexcharts.js')}}"></script>

    <script>

        $(document).ready(function () {
            var chartCol = $('#chartCol').data('chart');
            // var myChartData=JSON.parse(data);
            var months = chartCol.months;
            var countOfUsers = chartCol.trips;
            var options = {
                series: [{
                    name: 'رحلة',
                    data: countOfUsers
                }],
                annotations: {
                    points: [{
                        x: 'Bananas',
                        seriesIndex: 0,
                        label: {
                            borderColor: '#775DD0',
                            offsetY: 0,
                            style: {
                                color: '#fff',
                                background: '#775DD0',
                            },
                            text: 'Bananas are good',
                        }
                    }]
                },
                chart: {
                    height: 350,
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        borderRadius: 5,
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2
                },

                grid: {
                    row: {
                        colors: ['#fff', '#f2f2f2']
                    }
                },
                xaxis: {
                    labels: {
                        rotate: -45
                    },
                    categories: months,
                    tickPlacement: 'on'
                },
                yaxis: {
                    title: {
                        text: 'الحجوزات',
                    },
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: "horizontal",
                        shadeIntensity: 0.25,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 0.85,
                        opacityTo: 0.85,
                        stops: [50, 0, 100]
                    },
                }
            };

            var chart = new ApexCharts(document.querySelector("#chartCol"), options);
            chart.render();


        });

    </script>


@endpush
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="row mt-5">
                <div class="col-12">
                    {{--            $today_trips--}}

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">حجوزات اليوم </h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الزبون</th>
                                    <th>رقم الزبون</th>
                                    <th>عدد الباصات </th>
                                    <th>وقت الوصول</th>
                                    <th>وقت العودة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($today_trips as  $key=>$trip)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{@$trip->customer->name}}</td>
                                        <td>{{@$trip->customer->mobile}}</td>
                                        <td>
                                           {{$trip->vehicles_count}}
                                        </td>
                                        <td>{{@$trip->arrival_time}}</td>
                                        <td>{{@$trip->return_time}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row g-5 g-xl-8">
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8" style="color:white !important;">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                            <span class="fa fa-bus fa-4x" style="color: white"></span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5" style="color:white !important;">{{@$trips_count}}</div>
                            <div class="fw-bold text-gray-400" style="color:white !important;">الحجوزات</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                            <span class="fa fa-users fa-4x" style="color:white">

                                </span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">+{{@$customers_count}}</div>
                            <div class="fw-bold text-gray-100">الزبائن</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="fa fa-user-friends fa-4x" style="color: white"></span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{@$drivers_count}}</div>
                            <div class="fw-bold text-white">السائقين</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                            <span class="fa fa-coins fa-4x" style="color: white"></span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">  {{@$trip_total_price}}  </div>
                            <div class="fw-bold text-white">اجمالي الحجوزات بالشيكل</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    {{--            $today_trips--}}

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">الاحصائية السنوية </h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chartCol" data-chart="{{ json_encode($trips_statistics , true) }}">

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
