@extends('layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">congratulations {{auth()->user()->name}} ! 🎉</h5>
                                {{--<p class="mb-4">
                                    {{__('page.you_are_login_as')}} <span class="fw-bold">{{auth()?->user()?->getRoleNames()?->first() ?? "Super Admin"}}</span>
                                </p>--}}

                                {{--                                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>--}}
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-window"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title mb-2">0</h3>
                        {{--                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-building-gear"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-people"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-list-check"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-list-stars"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-cart"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">Card Title</span>
                        <h3 class="card-title text-nowrap mb-1">0</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>


    <script>
        const xValues = ['11-12-2024', '15-12-2024'];
        const dataSets = [
            {
                label: 'My-Label',
                data: [11,12],
                borderColor: 'red',
                fill: false,
                borderWidth: 2
            }
        ];

        new Chart("myChart", {
            type: "line",
            data: {
                labels: xValues,
                datasets: dataSets
            },
            options: {
                title: {
                    display: true,
                    text: "My Chart Name"
                },
                legend: {
                    display: true
                }
            }
        });
    </script>

@endsection
