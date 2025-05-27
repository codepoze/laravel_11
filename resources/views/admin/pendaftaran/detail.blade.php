<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal mt-2">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Kendaraan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->toKendaraan->no_pol }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Metode</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->toMetode->nama }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">No SO</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->no_so }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Nama</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->nama }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Tujuan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->tujuan }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">No HP</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->no_hp }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">No Identitas</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->no_identitas }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Tanggal Daftar</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ tgl_indo($pendataran->created_at) }}" readonly="readonly" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">Jam Daftar</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ get_waktu($pendataran->created_at) }}" readonly="readonly" />
                                </div>
                            </div>
                            @if ($pendataran->toAntrean)
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">No Antrean</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control-plaintext" value="{{ $pendataran->toAntrean->no_antrean }}" readonly="readonly" />
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">Pendaftaran Produk</h4>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered" id="tabel-pendaftaran_produk-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end:: content -->

    <!-- begin:: js local -->
    @push('js')
    <script src="{{ asset_admin('vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset_admin('vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>

    <script>
        var table;

        let untukTabel = function() {
            table = $('#tabel-pendaftaran_produk-dt').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                    processing: "Data sedang diproses...",
                },
                ajax: "{{ route('admin.pendaftaran_produk.list', my_encrypt($pendataran->id_pendaftaran)) }}",
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                drawCallback: function() {
                    feather.replace();
                },
                columns: [{
                        title: 'No.',
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        title: 'Produk',
                        data: 'to_produk.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'Satuan',
                        data: 'to_produk.to_satuan.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'Qty',
                        data: 'qty',
                        class: 'text-center'
                    },
                    {
                        title: 'Palet',
                        data: 'palet',
                        class: 'text-center'
                    },
                    {
                        title: 'Remark',
                        data: 'remark',
                        class: 'text-center'
                    },
                ],
            });
        }();
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>