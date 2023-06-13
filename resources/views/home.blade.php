@extends('layouts.app')
@php
    function diffPercent($array)
    {
        try {
            return round((($array[array_key_last($array)] - ($array[array_key_last($array) - 1] ?: $array[0])) / ($array[array_key_last($array)] ?: $array[array_key_last($array) - 1])) * 100, 0);
        } catch (\Throwable $th) {
            return 0;
        }
    }
    function hasMinusSign($value)
    {
        return substr(strval($value), 0, 1) == '-';
    }
@endphp
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
    </ol>
    <div class="container-fluid">
        @include('flash::message')
        <div class="animated fadeIn">
            @if (Auth::guard('pelanggan')->check())
                <div class="row ">
                    {{-- transaksi --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $card['transaksi'][array_key_last($card['transaksi'])] }}
                                        Transaksi <span class="fs-6 fw-normal">({{ diffPercent($card['transaksi']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['transaksi'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span></div>
                                    <div>Transaksi</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-transaksi" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- pengeluaran --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-info">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">Rp.
                                        {{ array_sum($card['pengeluaran']) }} <span
                                            class="fs-6 fw-normal">({{ diffPercent($card['pengeluaran']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['pengeluaran'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span></div>
                                    <div>Total Pengeluaran</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-pengeluaran" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- tanggungan --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-warning">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">Rp. -
                                        {{ array_sum($card['tanggungan']) }}
                                        <span class="fs-6 fw-normal">({{ diffPercent($card['tanggungan']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['tanggungan'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span>
                                    </div>
                                    <div>Total Tanggungan</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-tanggungan" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- Data Batal --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-danger">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">{{ array_sum($card['batal']) }} Transaksi <span
                                            class="fs-6 fw-normal">({{ diffPercent($card['batal']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['batal'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span></div>
                                    <div>Batal</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-batal" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row ">
                    {{-- pelanggan --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-primary">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $card['pelanggan'][array_key_last($card['pelanggan'])] }}
                                        Akun <span class="fs-6 fw-normal">({{ diffPercent($card['pelanggan']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['pelanggan'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span></div>
                                    <div>Pelanggan</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-pelanggan" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- Pendapatan --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-info">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">Rp.
                                        {{ $card['pendapatan'][array_key_last($card['pendapatan'])] }} <span
                                            class="fs-6 fw-normal">({{ diffPercent($card['pendapatan']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['pendapatan'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span></div>
                                    <div>Pendapatan</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-pendapatan" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- Penyewaan --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-warning">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">
                                        {{ $card['penyewaan'][array_key_last($card['penyewaan'])] }} Mobil
                                        <span class="fs-6 fw-normal">({{ diffPercent($card['penyewaan']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['penyewaan'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span>
                                    </div>
                                    <div>Total Penyewaan</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-penyewaan" height="70" width="294"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 294px;"></canvas>
                            </div>
                        </div>
                    </div>
                    {{-- Data Sopir --}}
                    <div class="col-sm-6 col-lg-3">
                        <div class="card mb-4 text-white bg-danger">
                            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold">{{ $card['sopir'][array_key_last($card['sopir'])] }}
                                        <span class="fs-6 fw-normal">({{ diffPercent($card['sopir']) }}% <i
                                                class="fa fa-arrow-{{ hasMinusSign(diffPercent($card['sopir'])) ? 'down' : 'up' }}"
                                                aria-hidden="true"></i>)</span>
                                    </div>
                                    <div>Sopir</div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                                <canvas class="chart" id="card-chart-sopir" height="70" width="262"
                                    style="display: block; box-sizing: border-box; height: 70px; width: 262px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="card-title mb-0">Trafik Penyewaan Mobil</h4>
                                <div class="small text-medium-emphasis">{{ $labels[0] }} -
                                    {{ $labels[array_key_last($labels)] }} {{ date('Y') }}</div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                            <canvas class="chart" id="rental-car-chart" height="300" width="583"
                                style="display: block; box-sizing: border-box; height: 300px; width: 583px;"></canvas>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('scripts')
    @if (Auth::guard('pelanggan')->check())
        <script>
            $(function() {
                cardChart($('#card-chart-transaksi'), {!! json_encode($labels) !!},
                    'Transaksi',
                    {!! json_encode($card['transaksi']) !!});
                cardChart($('#card-chart-pengeluaran'), {!! json_encode($labels) !!},
                    'Pengeluaran',
                    {!! json_encode($card['pengeluaran']) !!});
                cardChart($('#card-chart-batal'), {!! json_encode($labels) !!},
                    'Batal',
                    {!! json_encode($card['batal']) !!});
            });
        </script>
    @else
        <script>
            $(function() {
                // card chart
                cardChart($('#card-chart-pelanggan'), {!! json_encode($labels) !!},
                    'Pelanggan',
                    {!! json_encode($card['pelanggan']) !!});
                cardChart($('#card-chart-pendapatan'), {!! json_encode($labels) !!},
                    'Pendapatan',
                    {!! json_encode($card['pendapatan']) !!});
                cardChart($('#card-chart-penyewaan'), {!! json_encode($labels) !!},
                    'Penyewaan',
                    {!! json_encode($card['penyewaan']) !!});
                cardChart($('#card-chart-sopir'), {!! json_encode($labels) !!},
                    'Sopir', {!! json_encode($card['sopir']) !!});
                mainChart($('#rental-car-chart'), {!! json_encode($labels) !!}, {!! json_encode($chart) !!})
            })
        </script>
    @endif
    <script>
        const chartOption = {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        };
        const cardChart = (element, labels, label, data) => new Chart(element, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    backgroundColor: 'transparent',
                    borderColor: 'rgba(255,255,255,.55)',
                    data: data,
                }, ]
            },
            options: chartOption

        });
        const mainChart = (element, labels, datasets) => new Chart(element, {
            type: 'line',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 0,
                        ticks: {
                            // precision: 0,
                            beginAtZero: true,
                        }
                    }
                },
                elements: {
                    line: {
                        borderWidth: 1
                    },
                    point: {
                        radius: 4,
                        hitRadius: 10,
                        hoverRadius: 4
                    }
                }
            }
        });
    </script>
@endpush
