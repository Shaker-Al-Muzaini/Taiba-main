@extends('agent.layouts.app')
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
                        text: 'الرحلات',
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


            <div class="row g-5 g-xl-8">
                <div class="col-xl-3">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                            <span class="fa fa-bus fa-4x" style="color: orange"></span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{@$trips_count}}</div>
                            <div class="fw-bold text-gray-400">الرحلات</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>


{{--                <div class="col-xl-3">--}}
{{--                    <!--begin::Statistics Widget 5-->--}}
{{--                    <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">--}}
{{--                        <!--begin::Body-->--}}
{{--                        <div class="card-body">--}}
{{--                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->--}}
{{--                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">--}}
{{--													<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"--}}
{{--                                                         viewBox="0 0 24 24" fill="none">--}}
{{--														<path opacity="0.3"--}}
{{--                                                              d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z"--}}
{{--                                                              fill="black"></path>--}}
{{--														<path--}}
{{--                                                            d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z"--}}
{{--                                                            fill="black"></path>--}}
{{--													</svg>--}}
{{--												</span>--}}
{{--                            <!--end::Svg Icon-->--}}
{{--                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">  {{@$trip_total_price}}  </div>--}}
{{--                            <div class="fw-bold text-white">اجمالي الرحلات بالشيكل</div>--}}
{{--                        </div>--}}
{{--                        <!--end::Body-->--}}
{{--                    </a>--}}
{{--                    <!--end::Statistics Widget 5-->--}}
{{--                </div>--}}
            </div>


            <div class="row mt-5">
                <div class="col-12">
                    {{--            $today_trips--}}

                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title">رحلات اليوم </h3>
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
                                            {{@$trip->vehicles_count}}
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
