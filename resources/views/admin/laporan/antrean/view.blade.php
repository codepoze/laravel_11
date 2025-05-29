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
                            <h4 class="card-title">Filter</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form form-horizontal mt-2">
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="from">Dari&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="from" name="from" value="{{ $from }}" />
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="to">Sampai&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <input type="date" class="form-control form-control-sm" id="to" name="to" value="{{ $to }}" />
                                </div>
                            </div>
                            <hr />
                            <button type="button" id="show" class="btn btn-sm btn-relief-success">
                                <i data-feather="eye"></i>&nbsp;<span>Lihat</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered" id="tabel-antrean-dt" style="width: 100%;">
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
            table = $('#tabel-antrean-dt').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                    processing: "Data sedang diproses...",
                },
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-sm btn-relief-info',
                        text: '<i data-feather="copy"></i>&nbsp;<span>Copy</span>',
                        title: function() {
                            return 'Laporan Antrean';
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-sm btn-relief-success',
                        text: '<i data-feather="download"></i>&nbsp;<span>Excel</span>',
                        title: function() {
                            return 'Laporan Antrean';
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-sm btn-relief-danger',
                        text: '<i data-feather="download"></i>&nbsp;<span>Pdf</span>',
                        title: function() {
                            return 'Laporan Antrean';
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-sm btn-relief-warning',
                        text: '<i data-feather="download"></i>&nbsp;<span>CSV</span>',
                        title: function() {
                            return 'Laporan Antrean';
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-relief-primary',
                        text: '<i data-feather="printer"></i>&nbsp;<span>Print</span>',
                        title: function() {
                            return 'Laporan Antrean';
                        }
                    }
                ],
                ajax: {
                    url: "{{ route('admin.antrean.list') }}",
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        from: function() {
                            return $('#from').val()
                        },
                        to: function() {
                            return $('#to').val()
                        },
                        id_barang: function() {
                            return $('#id_barang').val()
                        },
                    }
                },
                drawCallback: function() {
                    feather.replace();
                },
                columns: [{
                        title: 'No.',
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        title: 'No. Antrean',
                        data: 'no_antrean',
                        class: 'text-center'
                    },
                    {
                        title: 'Kendaraan',
                        data: 'to_pendaftaran.to_kendaraan.no_pol',
                        class: 'text-center'
                    },
                    {
                        title: 'Metode',
                        data: 'to_pendaftaran.to_metode.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'No. So',
                        data: 'to_pendaftaran.no_so',
                        class: 'text-center'
                    },
                    {
                        title: 'Nama',
                        data: 'to_pendaftaran.nama',
                        class: 'text-center'
                    },
                    {
                        title: 'Tujuan',
                        data: 'to_pendaftaran.tujuan',
                        class: 'text-center'
                    },
                    {
                        title: 'No. HP',
                        data: 'to_pendaftaran.no_hp',
                        class: 'text-center'
                    },
                    {
                        title: 'No. Identitas',
                        data: 'to_pendaftaran.no_identitas',
                        class: 'text-center'
                    },
                    {
                        title: 'Tanggal Daftar',
                        data: 'tanggal',
                        class: 'text-center'
                    },
                    {
                        title: 'Jam Daftar',
                        data: 'jam',
                        class: 'text-center'
                    },
                ],
            });

            $('#show').on('click', function() {
                table.ajax.reload();
            });
        }();
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>