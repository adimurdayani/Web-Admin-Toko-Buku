@extends('layouts.admin')
@section('title', 'Produk')
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
                            <h4 class="header-title">Tabel @yield('title')</h4>
                            <a href="{{ route('produk.create') }}" class="btn btn-primary float-right">Tambah</a>

                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Nama Toko</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Berat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($produk as $p)
                                    <tr>
                                        <td>{{ $p->nama_toko }}</td>
                                        <td class="table-user">
                                            <img src="{{ asset('storage/produk/'. $p->image) }}" alt="table-user" class="mr-2 rounded-circle">
                                            <a href="javascript:void(0);" class="text-body font-weight-normal">{{ $p->nama_produk }}</a>
                                        </td>
                                        <td>Rp.{{ number_format($p->harga) }}</td>
                                        <td>{{ $p->stok }} lusin</td>
                                        <td>{{ $p->berat }} kg</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $p->id) }}" class="badge badge-outline-warning">Edit</a>
                                            <a href="javascript:void(0);" data-id="{{ $p->id }}" class="badge badge-outline-danger btn-delete">Hapus
                                                <form action="{{ route('produk.destroy', $p->id) }}" method="POST" id="delete{{ $p->id }}">
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
