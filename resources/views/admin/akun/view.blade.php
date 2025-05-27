<x-admin-layout title="{{ $title }}">
    <!-- begin:: css local -->
    @push('css')
    @endpush
    <!-- end:: css local -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-2 active" id="v-pills-foto-tab" data-bs-toggle="pill" href="#v-pills-foto" role="tab" aria-controls="v-pills-foto" aria-selected="true">
                                    <i class="fa fa-image"></i>&nbsp;
                                    Foto
                                </a>
                                <a class="nav-link mb-2" id="v-pills-akun-tab" data-bs-toggle="pill" href="#v-pills-akun" role="tab" aria-controls="v-pills-akun" aria-selected="false">
                                    <i class="fa fa-address-card"></i>&nbsp;
                                    Akun
                                </a>
                                <a class="nav-link mb-2" id="v-pills-keamanan-tab" data-bs-toggle="pill" href="#v-pills-keamanan" role="tab" aria-controls="v-pills-keamanan" aria-selected="false">
                                    <i class="fa fa-key"></i>&nbsp;
                                    Keamanan
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <!-- begin:: foto -->
                                <div class="tab-pane fade show active" id="v-pills-foto" role="tabpanel" aria-labelledby="v-pills-foto-tab">
                                    <form id="form-foto" action="{{ route('admin.akun.save_picture') }}" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6 align-self-center">
                                                <div class="field-input">
                                                    <input type="file" name="foto" id="foto" class="form-control form-control-sm" />
                                                    <span class="invalid-feedback"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <img src="{{ ($user->foto === null) ? '//placehold.co/150' : asset_upload('picture/akun/'.$user->foto) }}" class="img-fluid mx-auto d-block" id="lihat-gambar" alt="Profil" width="200" />
                                                <br>
                                                <div class="text-center">
                                                    <button type="submit" id="save-foto" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: foto -->
                                <!-- begin:: akun -->
                                <div class="tab-pane fade" id="v-pills-akun" role="tabpanel" aria-labelledby="v-pills-akun-tab">
                                    <form id="form-akun" action="{{ route('admin.akun.save_account') }}" method="POST">
                                        <div class="mb-3 row field-input">
                                            <label for="name" class="col-sm-3 col-form-label">Name&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ $user->name }}" placeholder="Masukkan nama Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="email" class="col-sm-3 col-form-label">Email&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ $user->email }}" placeholder="Masukkan e-mail Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="username" class="col-sm-3 col-form-label">Username&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="text" name="username" id="username" class="form-control form-control-sm" value="{{ $user->username }}" placeholder="Masukkan username Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" id="save-akun" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: akun -->
                                <!-- begin:: keamanan -->
                                <div class="tab-pane fade" id="v-pills-keamanan" role="tabpanel" aria-labelledby="v-pills-keamanan-tab">
                                    <form id="form-keamanan" action="{{ route('admin.akun.save_security') }}" method="POST">
                                        <div class="mb-3 row field-input">
                                            <label for="password_old" class="col-sm-3 col-form-label">Password Lama&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="password_old" id="password_old" class="form-control form-control-sm" placeholder="Masukkan password lama Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="password" class="col-sm-3 col-form-label">Password Baru&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Masukkan password baru Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row field-input">
                                            <label for="password_confirmation" class="col-sm-3 col-form-label">Ulangin Password Baru&nbsp;*</label>
                                            <div class="col-md-9 my-auto">
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm" placeholder="Masukkan kembali password Anda" />
                                                <span class="invalid-feedback"></span>
                                            </div>
                                        </div>
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" id="save-keamanan" class="btn btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;Save</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end:: keamanan -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- begin:: js local -->
    @push('js')
    <script type="text/javascript" src="{{ asset_admin('my_assets/parsley/2.9.2/parsley.js') }}"></script>

    <script>
        let untukChangePicture = function() {
            $("#foto").change(function() {
                cekLokasiFoto(this);
            });
        }();

        let untukSimpanFoto = function() {
            $(document).on('submit', '#form-foto', function(e) {
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
                        $('#save-foto').attr('disabled', 'disabled');
                        $('#save-foto').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-foto').removeAttr('disabled');
                        $('#save-foto').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            });

            $(document).on('change', '#form-foto input[type="file"]', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanAkun = function() {
            $(document).on('submit', '#form-akun', function(e) {
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
                        $('#save-akun').attr('disabled', 'disabled');
                        $('#save-akun').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-akun').removeAttr('disabled');
                        $('#save-akun').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });
            });

            $(document).on('keyup', '#form-akun input', function(e) {
                e.preventDefault();

                if ($(this).val() == '') {
                    $(this).removeClass('is-valid').addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });
        }();

        let untukSimpanKeamanan = function() {
            $(document).on('submit', '#form-keamanan', function(e) {
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
                        $('#save-keamanan').attr('disabled', 'disabled');
                        $('#save-keamanan').html('<i class="fa fa-spinner fa-spin"></i>&nbsp;Menunggu...');
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
                                location.reload();
                            });
                        } else {
                            $.each(response.errors, function(key, value) {
                                if (key) {
                                    if (($('#' + key).prop('tagName') === 'INPUT' || $('#' + key).prop('tagName') === 'TEXTAREA')) {
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

                        $('#save-keamanan').removeAttr('disabled');
                        $('#save-keamanan').html('<i class="fa fa-save"></i>&nbsp;Simpan');
                    }
                });

                $(document).on('keyup', '#form-keamanan input', function(e) {
                    e.preventDefault();

                    if ($(this).val() == '') {
                        $(this).removeClass('is-valid').addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid').addClass('is-valid');
                    }
                });
            });
        }();

        function cekLokasiFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.readAsDataURL(input.files[0]);
                reader.onload = function(e) {
                    $('#lihat-gambar').attr('src', e.target.result);
                }
            }
        }
    </script>
    @endpush
    <!-- end:: js local -->
</x-admin-layout>