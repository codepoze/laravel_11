<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Permissions;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Permission', 'permission', 'view');
    }

    public function list()
    {
        $data = Permissions::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $action = '';
                if (can('permission-update')) {
                    $action .= '
                        <button type="button" id="upd" data-id="' . my_encrypt($row->id) . '" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    ';
                }
                if (can('permission-delete')) {
                    $action .= '
                        <button type="button" id="del" data-id="' . my_encrypt($row->id) . '" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                    ';
                }
                return $action;
            })
            ->make(true);
    }
}
