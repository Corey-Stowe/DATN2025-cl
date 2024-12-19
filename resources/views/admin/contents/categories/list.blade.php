@extends('layout.master')
@section('title')
    Admin | List Categories
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <h5 class="mb-0">List categories</h5>
                </div>
            </div>
            <hr>
            <div class="row flex-between-end">
                <div class="col-auto align-self-center">
                    <form class="row gy-2 gx-3 align-items-center" action="">
                        <div class="col-auto">
                            <label class="form-label" for="autoSizingInput">Name</label>
                            <input class="form-control" id="autoSizingInput" type="text" name="name" value="" />
                        </div>
                        <div class="col-auto">
                            <label class="form-label" for="autoSizingSelect">Parent item</label>
                            <select class="form-select" id="autoSizingSelect" name="parent_id">
                                <option value="" selected>Trống</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                                <option value="1">sdasd</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <div class="form-check mb-0">
                                <input class="form-check-input" id="autoSizingCheck" type="checkbox" value="1" checked
                                    name="is_active" />
                                <label class="form-check-label mb-0" for="autoSizingCheck">Is active</label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label class="form-label" for="basic-form-textarea">Description</label>
                            <textarea class="form-control" id="basic-form-textarea" rows="2" cols="50" name="description"></textarea>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" type="submit">Add new</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body px-0">
            <div class="tab-content">
                <div class="tab-pane preview-tab-pane active" role="tabpanel"
                    aria-labelledby="tab-dom-023429b2-f0b9-4091-bf3c-0936e4daf000"
                    id="dom-023429b2-f0b9-4091-bf3c-0936e4daf000">
                    <table class="table mb-0 data-table fs-10" data-datatables="data-datatables">
                        <thead class="bg-200">
                            <tr>
                                <th class="text-900 sort">Name</th>
                                <th class="text-900 sort">Slug</th>
                                <th class="text-900 sort">Description</th>
                                <th class="text-900 sort">Status</th>
                                <th class="text-900 sort text-end">Parent item</th>
                                <th class="text-900 no-sort pe-1 align-middle data-table-row-action"></th>
                            </tr>
                        </thead>
                        <tbody class="list" id="table-simple-pagination-body">
                            <tr class="btn-reveal-trigger">
                                <td>sấdsda</td>
                                <td>sdfs-sdf-sdfsd</td>
                                <td>
                                    <strong>Null description</strong>
                                </td>
                                <td>
                                    <span class="badge badge rounded-pill badge-subtle-warning">No active</span>
                                    <span class="badge badge rounded-pill badge-subtle-success">Active</span>
                                </td>
                                <td class="text-end">
                                    <strong>Null parent</strong>
                                </td>
                                <td class="align-middle white-space-nowrap text-end">
                                    <div class="dropstart font-sans-serif position-static d-inline-block">
                                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal float-end"
                                            type="button" id="dropdown-simple-pagination-table-item-0"
                                            data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true"
                                            aria-expanded="false" data-bs-reference="parent">
                                            <span class="fas fa-ellipsis-h fs-10"></span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end border py-2"
                                            aria-labelledby="dropdown-simple-pagination-table-item-0">
                                            <a class="dropdown-item" href="">Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href=""
                                                onclick="return confirm('Có chắc chắn muốn xóa không!')">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js') }}"></script>
    <script src="{{ asset('theme/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.min.css') }}"></script>
@endsection
