<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/tables/datatable/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset_admin('vendors/css/extensions/select2.min.css') }}">
    @endpush
    <!-- end:: css local -->

    <!-- begin:: content -->
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <div class="head-label">
                            <h4 class="card-title">Formulir Pendaftaran</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="form-pendaftaran" class="form form-horizontal mt-2" action="{{ route('admin.pendaftaran.save') }}" method="POST">
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_kendaraan">Kendaraan&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="flex-grow-1">
                                            <select name="id_kendaraan" id="id_kendaraan" class="form-control">
                                                <option value=""></option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-relief-primary" title="Tambah Kendaraan" data-bs-toggle="modal" data-bs-target="#modal-kendaraan">
                                            <i data-feather="plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="id_metode">Metode&nbsp;*</label>
                                </div>
                                <div class="col-sm-9 my-auto">
                                    <select name="id_metode" id="id_metode" class="form-control">
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_so">No SO&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="no_so" name="no_so" placeholder="Masukkan no so" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="distributor">Distributor</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="distributor" name="distributor" placeholder="Masukkan distributor" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="nama">Nama&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="nama" name="nama" placeholder="Masukkan nama" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="tujuan">Tujuan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="tujuan" name="tujuan" placeholder="Masukkan tujuan" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_hp">No HP&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="no_hp" name="no_hp" placeholder="Masukkan no hp" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="no_identitas">No Identitas&nbsp;*</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="no_identitas" name="no_identitas" placeholder="Masukkan no identitas" />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="field-input mb-1 row">
                                <div class="col-sm-3">
                                    <label class="col-form-label" for="count-t_pendaftaran_produk">Pendaftaran Produk</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control form-control" id="count-t_pendaftaran_produk" name="count-t_pendaftaran_produk" value="0" readonly />
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <button type="submit" id="save-pendaftaran" class="btn btn-sm btn-relief-success">
                                <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                            </button>
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
                        <div class="dt-action-buttons text-end">
                            <div class="dt-buttons d-inline-flex">
                                <button type="button" id="add-t_pendaftaran_produk" class="btn btn-sm btn-relief-success" data-bs-toggle="modal" data-bs-target="#modal-t_pendaftaran_produk">
                                    <i data-feather='plus'></i>&nbsp;<span>Tambah</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="table table-striped table-bordered" id="tabel-t_pendaftaran_produk-dt" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- begin:: modal kendaraan -->
    <div id="modal-kendaraan" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kendaraan</h4>
                </div>
                <!-- begin:: untuk form -->
                <form id="form-kendaraan" class="form form-horizontal" action="{{ route('admin.kendaraan.save') }}" method="POST">
                    <div class="modal-body">
                        <!-- begin:: untuk loading -->
                        <div id="form-loading"></div>
                        <!-- end:: untuk loading -->
                        <div id="form-show">
                            <div class="row">
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="no_pol">No Polisi&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="no_pol" name="no_pol" placeholder="Masukkan no polisi" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="jenis">Jenis&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="jenis" id="jenis" class="form-select form-select-sm">
                                                <option value="">-- Pilih --</option>
                                                <option value="mobil">Mobil</option>
                                                <option value="motor">Motor</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancel" class="btn btn-sm btn-relief-danger" data-bs-dismiss="modal">
                            <i data-feather="x"></i>&nbsp;<span>Batal</span>
                        </button>
                        <button type="submit" id="save-kendaraan" class="btn btn-sm btn-relief-primary">
                            <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                        </button>
                    </div>
                </form>
                <!-- end:: untuk form -->
            </div>
        </div>
    </div>
    <!-- end:: modal kendaraan -->

    <!-- begin:: modal t_pendaftaran_produk -->
    <div id="modal-t_pendaftaran_produk" class="modal fade text-start" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><span id="judul-add-upd"></span> Produk</h4>
                </div>
                <!-- begin:: untuk form -->
                <form id="form-t_pendaftaran_produk" class="form form-horizontal" action="{{ route('admin.t_pendaftaran_produk.save') }}" method="POST">
                    <div class="modal-body">
                        <!-- begin:: untuk loading -->
                        <div id="form-loading"></div>
                        <!-- end:: untuk loading -->
                        <div id="form-show">
                            <div class="row">
                                <!-- begin:: id -->
                                <input type="hidden" name="id_t_pendaftaran_produk" id="id_t_pendaftaran_produk" />
                                <!-- end:: id -->
                                <div class="col-12">
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="id_produk">Nama&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <select name="id_produk" id="id_produk" class="form-control form-control-sm">
                                                <option value="">Pilih</option>
                                                @foreach($produk as $row)
                                                <option value="{{ $row->id_produk }}" data-id="{{ my_encrypt($row->id_produk) }}">{{ $row->nama }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="qty">Qty&nbsp;*</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm inputNumber" id="qty" name="qty" placeholder="Masukkan qty" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="palet">Palet</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="palet" name="palet" placeholder="Masukkan palet" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="field-input mb-1 row">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="remark">Remark</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control form-control-sm" id="remark" name="remark" placeholder="Masukkan remark" />
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="cancel" class="btn btn-sm btn-relief-danger" data-bs-dismiss="modal">
                            <i data-feather="x"></i>&nbsp;<span>Batal</span>
                        </button>
                        <button type="submit" id="save-t_pendaftaran_produk" class="btn btn-sm btn-relief-primary">
                            <i data-feather="save"></i>&nbsp;<span>Simpan</span>
                        </button>
                    </div>
                </form>
                <!-- end:: untuk form -->
            </div>
        </div>
    </div>
    <!-- end:: modal t_pendaftaran_produk -->
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
    <script src="{{ asset_admin('vendors/js/extensions/select2.full.min.js') }}"></script>

    <script>
        untukReloadKendaraan();

        untukReloadMetode();

        var table;

        let untukTabelTPendaftaranProduk = function() {
            table = $('#tabel-t_pendaftaran_produk-dt').DataTable({
                serverSide: true,
                responsive: true,
                processing: true,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    emptyTable: "Tak ada data yang tersedia pada tabel ini.",
                    processing: "Data sedang diproses...",
                },
                ajax: "{{ route('admin.t_pendaftaran_produk.list') }}",
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                drawCallback: function() {
                    feather.replace();

                    var info = table.page.info();

                    $('#count-t_pendaftaran_produk').val(info.recordsTotal);
                },
                columns: [{
                        title: 'No.',
                        data: 'DT_RowIndex',
                        class: 'text-center'
                    },
                    {
                        title: 'Nama',
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
                    {
                        title: 'Aksi',
                        data: 'action',
                        className: 'text-center',
                        responsivePriority: -1,
                        orderable: false,
                        searchable: false,
                    },
                ],
            });
        }();

        let untukTambahTPendaftaranProduk = function() {
            $(document).on('click', '#add-t_pendaftaran_produk', function(e) {
                e.preventDefault();
                $('#judul-add-upd').text('Tambah');

                $('#id_t_pendaftaran_produk').removeAttr('value');

                $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-valid');
                $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-invalid');

                $('#form-t_pendaftaran_produk').parsley().destroy();
                $('#form-t_pendaftaran_produk').parsley().reset();
                $('#form-t_pendaftaran_produk')[0].reset();
            });
        }();

        let untukUbahTPendaftaranProduk = function() {
            $(document).on('click', '#upd-t_pendaftaran_produk', function(e) {
                var ini = $(this);

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "{{ route('admin.t_pendaftaran_produk.show') }}",
                    data: {
                        id: ini.data('id')
                    },
                    beforeSend: function() {
                        $('#judul-add-upd').html('Ubah');
                        $('#form-loading').html(`<div class="center"><div class="loader"></div></div>`);
                        $('#form-show').attr('style', 'display: none');

                        $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-valid');
                        $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-invalid');

                        ini.attr('disabled', 'disabled');
                        ini.html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                        feather.replace();
                    },
                    success: function(response) {
                        $('#form-loading').empty();
                        $('#form-show').removeAttr('style');

                        $.each(response, function(key, value) {
                            if (key) {
                                if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                    $('#' + key).val(value);
                                } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                    $('#' + key).val(value);
                                }
                            }
                        });

                        ini.removeAttr('disabled');
                        ini.html('<i data-feather="edit"></i>&nbsp;<span>Ubah</span>');
                        feather.replace();
                    }
                });
            });
        }();

        let untukHapusTPendaftaranProduk = function() {
            $(document).on('click', '#del-t_pendaftaran_produk', function() {
                var ini = $(this);

                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapusnya?",
                    text: "Data yang telah dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Iya, Hapus!',
                    customClass: {
                        confirmButton: 'btn btn-sm btn-success',
                        cancelButton: 'btn btn-sm btn-danger ms-1'
                    },
                    buttonsStyling: false
                }).then(function(result) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.t_pendaftaran_produk.del') }}",
                        dataType: 'json',
                        data: {
                            id: ini.data('id'),
                            password: result.value,
                        },
                        beforeSend: function() {
                            ini.attr('disabled', 'disabled');
                            ini.html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                            feather.replace();
                        },
                        success: function(response) {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                table.ajax.reload();
                            });
                        }
                    });
                });
            });
        }();

        let untukSimpanTPendaftaranProduk = function() {
            $(document).on('submit', '#form-t_pendaftaran_produk', function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-valid');
                        $('#form-t_pendaftaran_produk').find('input, textarea, select').removeClass('is-invalid');

                        $('#save-t_pendaftaran_produk').attr('disabled', 'disabled');
                        $('#save-t_pendaftaran_produk').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                        feather.replace();
                    },
                    success: function(response) {
                        if (response.type === 'success') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                $('#modal-t_pendaftaran_produk').modal('hide');
                                table.ajax.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });

                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            });
                        }

                        $('#save-t_pendaftaran_produk').removeAttr('disabled');
                        $('#save-t_pendaftaran_produk').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });
            });

            $(document).on('keyup', '#form-t_pendaftaran_produk input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-t_pendaftaran_produk select', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanPendaftaran = function() {
            $(document).on('submit', '#form-pendaftaran', function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-pendaftaran').find('input, textarea, select').removeClass('is-valid');
                        $('#form-pendaftaran').find('input, textarea, select').removeClass('is-invalid');

                        $('#save-pendaftaran').attr('disabled', 'disabled');
                        $('#save-pendaftaran').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                        feather.replace();
                    },
                    success: function(response) {
                        if (response.type === 'success') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                location.href = response.url;
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });

                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            });
                        }

                        $('#save-pendaftaran').removeAttr('disabled');
                        $('#save-pendaftaran').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });
            });

            $(document).on('keyup', '#form-pendaftaran input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-pendaftaran select', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanKendaraan = function() {
            $(document).on('submit', '#form-kendaraan', function(e) {
                e.preventDefault();

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#form-kendaraan').find('input, textarea, select').removeClass('is-valid');
                        $('#form-kendaraan').find('input, textarea, select').removeClass('is-invalid');

                        $('#save-kendaraan').attr('disabled', 'disabled');
                        $('#save-kendaraan').html('<i data-feather="refresh-ccw"></i>&nbsp;<span>Menunggu...</span>');
                        feather.replace();
                    },
                    success: function(response) {
                        if (response.type === 'success') {
                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            }).then((value) => {
                                $('#modal-kendaraan').modal('hide');

                                $('#form-kendaraan').parsley().destroy();
                                $('#form-kendaraan').parsley().reset();
                                $('#form-kendaraan')[0].reset();

                                untukReloadKendaraan();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    } else if ($('#' + key).prop('tagName') === 'SELECT') {
                                        $('#' + key).addClass('is-invalid');
                                        $('#' + key).parents('.field-input').find('.invalid-feedback').html(value);
                                    }
                                }
                            });

                            Swal.fire({
                                title: response.title,
                                text: response.text,
                                icon: response.type,
                                confirmButtonText: response.button,
                                customClass: {
                                    confirmButton: `btn btn-sm btn-${response.class}`,
                                },
                                buttonsStyling: false,
                            });
                        }

                        $('#save-kendaraan').removeAttr('disabled');
                        $('#save-kendaraan').html('<i data-feather="save"></i>&nbsp;<span>Simpan</span>');
                        feather.replace();
                    }
                });
            });

            $(document).on('keyup', '#form-kendaraan input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            $(document).on('change', '#form-kendaraan select', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        function untukReloadKendaraan() {
            $.get("{{ route('admin.kendaraan.all') }}", function(response) {
                $("#id_kendaraan").select2({
                    placeholder: "Pilih Kendaraan",
                    width: '100%',
                    allowClear: true,
                    data: response,
                });
            }, 'json');
        }

        function untukReloadMetode() {
            $.get("{{ route('admin.metode.all') }}", function(response) {
                $("#id_metode").select2({
                    placeholder: "Pilih Metode",
                    width: '100%',
                    allowClear: true,
                    data: response,
                });
            }, 'json');
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>