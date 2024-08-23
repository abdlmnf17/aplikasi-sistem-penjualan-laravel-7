@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <!-- Logo Perusahaan dan Keterangan -->
            <div class="card-body d-flex justify-content-between align-items-center">
                <img src="{{ asset('/asset/img/sate.png') }}" width="100" height="40" alt="Logo Perusahaan"
                    class="img-fluid" style="max-height: 100px;">

                <h4 class="text-muted">Dashboard</h4>
            </div>
        </div>



        <!-- Container Pembungkus untuk Card -->
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="row">
                    <!-- Card: Total Menu -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Menu</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMenu }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-utensils fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Metode Pembayaran -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Metode
                                            Pembayaran</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPembayaran }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-credit-card fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Pelanggan -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total
                                            Pelanggan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPelanggan }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-users fa-2x text-danger"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Pemesanan (Pending) -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total
                                            Pemesanan (Pending)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemesanan }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Invoice Keluar -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Total
                                            Invoice Keluar</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalInvoice }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-file-invoice-dollar fa-2x text-secondary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Penjualan (Sukses) -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total
                                            Penjualan (Sukses)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPenjualan }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-chart-line fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Total Pendapatan -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total
                                            Pendapatan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                            {{ number_format($totalSaldoMenu, 2, ',', '.') }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card: Hak Akses -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Hak Akses
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Auth::user()->name }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-shield fa-2x text-success"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
