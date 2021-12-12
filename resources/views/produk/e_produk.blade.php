@extends('layouts.admin')
@section('title', 'Tambah Produk')
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
                                <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@yield('title')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <form action="{{ route('produk.update', $produk->id) }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">General</h5>

                            <input type="hidden" id="toko_id" name="toko_id" class="form-control" value="{{ Auth::user()->id }}">
                            <input type="hidden" id="nama_toko" name="nama_toko" class="form-control" value="{{ Auth::user()->nama_toko }}">

                            <div class="form-group mb-3">
                                <label for="product-name">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" id="product-name" name="nama_produk" class="form-control" placeholder="e.g : Buku Sejarah" value="{{ $produk->nama_produk }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="harga">Harga <span class="text-danger">*</span></label>
                                <input type="number" id="harga" name="harga" class="form-control" placeholder="Rp.0" required value="{{ $produk->harga }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="product-description">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="product-description" name="deskripsi" rows="5" placeholder="Please enter deskripsi" required> {{ $produk->deskripsi }}</textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="stok">Stok Produk</label>
                                <input type="number" class="form-control" name="stok" id="stok" placeholder="e.g : 0 buah" required value="{{ $produk->stok }}"></input>
                            </div>

                            <div class="form-group mb-3">
                                <label for="berat">Berat Produk</label>
                                <input type="number" class="form-control" name="berat" id="berat" placeholder="e.g : 0 buah" required value="{{ $produk->berat }}"></input>
                            </div>

                            <div class="form-group mb-3">
                                <label for="kategori">Kategori <span class="text-danger">*</span></label>
                                <select class="form-control" name="kategori" id="kategori">
                                    <option>Select</option>
                                    @if ($produk->kategori == "BARU")
                                    <option value="BARU" selected>Baru</option>
                                    @else
                                    <option value="BARU">Baru</option>
                                    @endif
                                    @if($produk->kategori == "TERLARIS")
                                    <option value="TERLARIS" selected>Terlaris</option>
                                    @else
                                    <option value="TERLARIS">Terlaris</option>
                                    @endif
                                </select>
                            </div>

                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <div class="col-lg-6">

                        <div class="card-box">
                            <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Product Images</h5>
                            <div class="form-group">
                                <label for="image">Upload Gambar</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image">
                                        <label for="image" class="custom-file-label">Pilih file</label>
                                    </div>
                                </div>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Gambar tidak boleh kosong</strong>
                                </span>
                                @enderror
                                <img src="{{ asset('storage/produk/'.$produk->image) }}" alt="" class="img-thumbnail mt-3" width="30%">
                            </div>

                        </div> <!-- end col-->

                    </div> <!-- end col-->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="text-center mb-3">
                            <button type="button" class="btn w-sm btn-light waves-effect">Cancel</button>
                            <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Save</button>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </form>
        </div> <!-- container -->

    </div> <!-- content -->

    @endsection

    @push('page-scripts')
    <!-- Init js -->
    <!-- bs-custom-file-input -->
    <script src="{{ asset('assets/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

    </script>
    @endpush
