<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('admin.dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard.index'));
});


Breadcrumbs::for('admin.akun.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Akun', route('admin.akun.index'));
});

Breadcrumbs::for('admin.satuan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Satuan', route('admin.satuan.index'));
});

Breadcrumbs::for('admin.produk.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Produk', route('admin.produk.index'));
});

Breadcrumbs::for('admin.kendaraan.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Kendaraan', route('admin.kendaraan.index'));
});

Breadcrumbs::for('admin.metode.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Metode', route('admin.metode.index'));
});

Breadcrumbs::for('admin.pendaftaran.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Pendaftaran', route('admin.pendaftaran.index'));
});

Breadcrumbs::for('admin.pendaftaran.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pendaftaran.index');

    $trail->push('Tambah', route('admin.pendaftaran.create'));
});

Breadcrumbs::for('admin.pendaftaran.detail', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.pendaftaran.index');

    $trail->push('Detail', '#');
});

Breadcrumbs::for('admin.antrean.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');

    $trail->push('Antrean', route('admin.antrean.index'));
});
