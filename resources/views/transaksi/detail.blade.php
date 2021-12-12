@extends('layouts.admin')
@section('title', 'Detail Transaksi')
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
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('transaksi') }}">Transaksi</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@yield('title')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Track Order</h4>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h5 class="mt-0">Kode Order:</h5>
                                        <p>{{ $transaksi_id->kode_trx }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <h5 class="mt-0">Kode Payment:</h5>
                                        <p>{{ $transaksi_id->kode_payment }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="track-order-list">
                                <ul class="list-unstyled">
                                    <li class="completed">
                                        <h5 class="mt-0 mb-1">Order Placed</h5>
                                        <p class="text-muted">{{ $transaksi_id->created_at }} </p>
                                    </li>
                                    <li class="completed">
                                        <h5 class="mt-0 mb-1">Packed</h5>
                                        <p class="text-muted">{{ $transaksi_id->updated_at }}</p>
                                    </li>
                                    <li>
                                        <span class="active-dot dot"></span>
                                        <h5 class="mt-0 mb-1">Shipped</h5>
                                        <p class="text-muted">{{ $transaksi_id->updated_at }}</p>
                                    </li>
                                    <li>
                                        <h5 class="mt-0 mb-1"> Delivered</h5>
                                        <p class="text-muted">Estimated delivery within 3-5 days</p>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Items from Order {{ $transaksi_id->kode_trx }}</h4>

                            <div class="table-responsive">
                                <table class="table table-bordered table-centered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Produk</th>
                                            <th>Jumlah Item</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailtransaksi as $d)
                                        <tr>
                                            <th scope="row">{{ $d->produk->nama_produk }}</th>
                                            <td><img src="{{ asset('assets/images/products/product-1.png') }}" alt="product-img" height="32"></td>
                                            <td>{{ $d->total_item }}</td>
                                            <td>Rp.{{ number_format($d->produk->harga) }}</td>
                                            <td>Rp.{{ number_format($d->total_harga) }}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Shipping Information</h4>

                            <h5 class="font-family-primary font-weight-semibold">{{ $transaksi_id->name }}</h5>

                            <p class="mb-2"><span class="font-weight-semibold mr-2">Address:</span> {{ $transaksi_id->detail_lokasi }}</p>
                            <p class="mb-2"><span class="font-weight-semibold mr-2">Phone:</span> {{ $transaksi_id->phone }}</p>

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Billing Information</h4>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p class="mb-2"><span class="font-weight-semibold mr-2">Payment Type:</span> {{ $transaksi_id->bank }}</p>
                                    <p class="mb-2"><span class="font-weight-semibold mr-2">Provider:</span> {{ $transaksi_id->bank }}</p>
                                    <p class="mb-2"><span class="font-weight-semibold mr-2">Valid Date:</span> 02/2020</p>
                                    <p class="mb-0"><span class="font-weight-semibold mr-2">CVV:</span> xxx</p>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-3">Delivery Info</h4>

                            <div class="text-center">
                                <i class="mdi mdi-truck-fast h2 text-muted"></i>
                                <h5><b>{{ $transaksi_id->kurir }} {{ $transaksi_id->jasa_pengiriman }}</b></h5>
                                <p class="mb-1"><span class="font-weight-semibold">Order ID :</span> #{{ $transaksi_id->kode_unik }}</p>
                                <p class="mb-0"><span class="font-weight-semibold">Payment Mode :</span> {{ $transaksi_id->metode }}</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->

    @endsection

    @push('page-scripts')

    @endpush

    @push('after-scripts')

    @endpush
