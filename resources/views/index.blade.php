<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@yield('title')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-primary">
                                    <i class="dripicons-wallet font-24 avatar-title text-primary"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1">$<span data-plugin="counterup">{{ $transaksi }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Total Transaksi</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-success">
                                    <i class="dripicons-basket font-24 avatar-title text-success"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $transaksi_menunggu }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Orders</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-info">
                                    <i class="dripicons-store font-24 avatar-title text-info"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $user }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Stores</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->

                <div class="col-md-6 col-xl-3">
                    <div class="widget-rounded-circle card-box">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-lg rounded bg-soft-warning">
                                    <i class="dripicons-user-group font-24 avatar-title text-warning"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-right">
                                    <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $transaksi_pembeli }}</span></h3>
                                    <p class="text-muted mb-1 text-truncate">Sellers</p>
                                </div>
                            </div>
                        </div> <!-- end row-->
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card-box pb-2">

                        <h4 class="header-title mb-3">Sales Analytics</h4>

                        <div class="row text-center">
                            <div class="col-md-4">
                                <p class="text-muted mb-0 mt-3">Menunggu</p>
                                <h2 class="font-weight-normal mb-3">
                                    <small class="mdi mdi-checkbox-blank-circle text-primary align-middle mr-1"></small>
                                    <span>{{ $transaksi_menunggu }}</span>
                                </h2>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-0 mt-3">Selesai</p>
                                <h2 class="font-weight-normal mb-3">
                                    <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                    <span>{{ $transaksi_pembeli }}</span>
                                </h2>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted mb-0 mt-3">Batal</p>
                                <h2 class="font-weight-normal mb-3">
                                    <small class="mdi mdi-checkbox-blank-circle text-success align-middle mr-1"></small>
                                    <span>{{ $transaksi_batal }}</span>
                                </h2>
                            </div>
                        </div>

                        <div id="revenue-chart" class="apex-charts mt-3" data-colors="#11ca6d,#1abc9c"></div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->

                <div class="col-xl-4">
                    <div class="card-box">

                        <h4 class="header-title mb-0">Total Penjualan</h4>

                        <div class="widget-chart text-center" dir="ltr">

                            <h5 class="text-muted mt-4">Total penjualan hari ini</h5>
                            <h2>Rp.{{ number_format($total) }}</h2>

                            <p class="text-muted w-75 mx-auto sp-line-2">Total penjualan dihitung berdasarkan transfer dana dari kostumer.</p>

                            <div class="row mt-4">
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">Menunggu</p>
                                    <h4><i class="fe-arrow-up text-warning mr-1"></i>{{ $transaksi_menunggu }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">Selesai</p>
                                    <h4><i class="fe-arrow-up text-success mr-1"></i>{{ $transaksi_pembeli }}</h4>
                                </div>
                                <div class="col-4">
                                    <p class="text-muted font-15 mb-1 text-truncate">Batal</p>
                                    <h4><i class="fe-arrow-down text-danger mr-1"></i>{{ $transaksi_batal }}</h4>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card-box -->
                </div> <!-- end col-->
            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Transaction History</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Nama</th>
                                        <th class="border-top-0">Metode Pembayaran</th>
                                        <th class="border-top-0">Tanggal Transaksi</th>
                                        <th class="border-top-0">Harga</th>
                                        <th class="border-top-0">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksihistori as $t)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/images/user.png') }}" alt="user-pic" class="rounded-circle avatar-sm bx-shadow-lg" />
                                            <span class="ml-2">{{ $t->costumer->nama }}</span>
                                        </td>
                                        <td>
                                            {{ $t->bank }}
                                        </td>
                                        <td> {{ $t->created_at }}</td>
                                        <td>Rp.{{ number_format($t->total_transfer) }}</td>
                                        <td>
                                            @if($t->status == "PROSES")
                                            <div class="badge badge-outline-info">{{ $t->status }}</div>
                                            @elseif($t->status == "DIBAYAR")
                                            <div class="badge badge-outline-primary">{{ $t->status }}</div>
                                            @elseif($t->status == "DIKIRIM")
                                            <div class="badge badge-outline-secondary">{{ $t->status }}</div>
                                            @elseif($t->status == "SELESAI")
                                            <div class="badge badge-outline-success">{{ $t->status }}</div>
                                            @elseif($t->status == "BATAL")
                                            <div class="badge badge-outline-danger">{{ $t->status }}</div>
                                            @elseif($t->status == "MENUNGGU")
                                            <div class="badge badge-outline-warning">{{ $t->status }}</div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->

                    </div> <!-- end card-box-->
                </div> <!-- end col-->
                <div class="col-xl-6">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Recent Products</h4>

                        <div class="table-responsive">
                            <table class="table table-centered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Produk</th>
                                        <th class="border-top-0">Kategori</th>
                                        <th class="border-top-0">Tanggal Buat</th>
                                        <th class="border-top-0">Harga</th>
                                        <th class="border-top-0">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $p)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('storage/produk/'. $p->image) }}" alt="product-pic" height="36" />
                                            <span class="ml-2">{{ $p->nama_produk }}</span>
                                        </td>
                                        <td>
                                            {{ $p->kategori }}
                                        </td>
                                        <td>{{ $p->created_at }}</td>
                                        <td>Rp.{{ number_format($p->harga) }}</td>
                                        <td>{{ $p->stok }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end card-box-->
                </div> <!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
    @endsection

    @push('page-scripts')

    @endpush

    @push('after-scripts')

    <script>
        ! function(r) {
            "use strict";

            function e() {
                this.$body = r("body"), this.charts = []
            }
            e.prototype.initCharts = function() {
                window.Apex = {
                    chart: {
                        parentHeightOffset: 0
                        , toolbar: {
                            show: !1
                        }
                    }
                    , grid: {
                        padding: {
                            left: 0
                            , right: 0
                        }
                    }
                    , colors: ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
                };
                var e = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
                    , t = r("#revenue-chart").data("colors");
                t && (e = t.split(","));
                var o = {
                    chart: {
                        height: 363
                        , type: "bar"
                        , dropShadow: {
                            enabled: !0
                            , opacity: .2
                            , blur: 7
                            , left: -7
                            , top: 7
                        }
                    }
                    , dataLabels: {
                        enabled: !1
                    }
                    , stroke: {
                        curve: "smooth"
                        , width: 1
                    }
                    , series: [{
                        name: "Menunggu"
                        , type: "bar"
                        , data: ['{{ $transaksi_menunggu }}']
                    }, {
                        name: "Selesai"
                        , type: "bar"
                        , data: ['{{ $transaksi_pembeli }}']
                    }]
                    , fill: {
                        type: "solid"
                        , opacity: [.35, 1]
                    }
                    , colors: e
                    , zoom: {
                        enabled: !1
                    }
                    , legend: {
                        show: !1
                    }
                    , xaxis: {
                        type: "string"
                        , categories: ["Menunggu", "Selesai"]
                        , tooltip: {
                            enabled: !1
                        }
                        , axisBorder: {
                            show: !1
                        }
                    }
                };
                new ApexCharts(document.querySelector("#revenue-chart"), o).render()
            }, e.prototype.init = function() {
                this.initCharts()
            }, r.Dashboard = new e, r.Dashboard.Constructor = e
        }(window.jQuery)
        , function(t) {
            "use strict";
            t(document).ready(function(e) {
                t.Dashboard.init()
            })
        }(window.jQuery);

    </script>
    @endpush
