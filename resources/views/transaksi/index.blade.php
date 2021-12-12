@extends('layouts.admin')
@section('title', 'Transaksi')
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
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@yield('title')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Tabel @yield('title') <div class="badge badge-outline-warning">MENUNGGU</div>
                            </h4>

                            <table class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Toko</th>
                                        <th>Total Transfer</th>
                                        <th>Phone</th>
                                        <th>Bank</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($transaksiMenunggu as $t_menunggu)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('assets/images/user.png') }}" alt="table-user" class="mr-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-normal">{{ $t_menunggu->user->nama_toko }}</a>
                                        </td>
                                        <td>{{ $t_menunggu->total_transfer }}</td>
                                        <td>{{ $t_menunggu->costumer->phone }}</td>
                                        <td>{{ $t_menunggu->bank }}</td>
                                        <td>
                                            <div class="badge badge-outline-warning">
                                                {{ $t_menunggu->status }}
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('transaksiProses',$t_menunggu->id) }}" class="badge badge-outline-blue">PROSES</a>
                                            <a href="{{ route('transaksiBatal',$t_menunggu->id) }}" class="badge badge-outline-danger">BATAL</a>
                                            <a href="javascript:void(0);" data-id="{{ $t_menunggu->id }}" class="badge badge-danger btn-delete">Hapus
                                                <form action="{{ route('hapus', $t_menunggu->id) }}" method="POST" id="delete{{ $t_menunggu->id }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Tabel @yield('title') <div class="badge badge-outline-info">DIPROSES</div>
                            </h4>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Toko</th>
                                        <th>Total Transfer</th>
                                        <th>Phone</th>
                                        <th>Bank</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($transaksiDiproses as $data)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('assets/images/user.png') }}" alt="table-user" class="mr-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-normal">{{ $data->user->nama_toko }}</a>
                                        </td>
                                        <td>{{ $data->total_transfer }}</td>
                                        <td>{{ $data->costumer->phone }}</td>
                                        <td>{{ $data->bank }}</td>
                                        <td>
                                            @if($data->status == "PROSES")
                                            <div class="badge badge-outline-info">
                                                {{ $data->status }}
                                            </div>
                                            @elseif($data->status == "DIBAYAR")
                                            <div class="badge badge-outline-primary">
                                                {{ $data->status }}
                                            </div>
                                            @elseif($data->status == "DIKIRIM")
                                            <div class="badge badge-outline-secondary">
                                                {{ $data->status }}
                                            </div>
                                            @elseif($data->status == "SELESAI")
                                            <div class="badge badge-outline-success">
                                                {{ $data->status }}
                                            </div>
                                            @elseif($data->status == "BATAL")
                                            <div class="badge badge-outline-danger">
                                                {{ $data->status }}
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->status == "DIKIRIM")
                                            <a href="{{ route('transaksiSelesai',$data->id) }}" class="badge badge-outline-blue">SELESAI</a>
                                            @endif

                                            @if($data->status == "PROSES")
                                            <a href="{{ route('transaksiKirim',$data->id) }}" class="badge badge-outline-blue">KIRIM</a>
                                            @endif

                                            @if($data->status == "SELESAI" || $data->status == "BATAL")
                                            <a href="{{ route('detail', $data->id) }}" class="badge badge-outline-blue">DETAIL</a>
                                            @endif

                                            @if($data->status == "DIBAYAR")
                                            <a href="{{ route('transaksiKirim',$data->id) }}" class="badge badge-outline-blue">PROSES</a>
                                            @endif

                                            <a href="javascript:void(0);" data-id="{{ $data->id }}" class="badge badge-outline-danger btn-delete">Hapus
                                                <form action="{{ route('produk.destroy', $data->id) }}" method="POST" id="delete{{ $data->id }}">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->
    </div>

    @endsection

    @push('page-scripts')
    <!-- Datatables init -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    @endpush

    @push('after-scripts')
    <script>
        $(".btn-delete").click(function(e) {
            id = e.target.dataset.id
            swal({
                    title: 'Yakin ingin menghapus? '
                    , text: 'Data akan di hapus secara permanen!'
                    , icon: 'warning'
                    , buttons: true
                    , dangerMode: true
                , })
                .then((willDelete) => {
                    if (willDelete) {
                        swal('Delete data success!', {
                            icon: 'success'
                        , });
                        $(`#delete${id}`).submit();
                    } else {
                        // swal('Your imaginary file is safe!');
                    }
                });
        });

    </script>

    @endpush
