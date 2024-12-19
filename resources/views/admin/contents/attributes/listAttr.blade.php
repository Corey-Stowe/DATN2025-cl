@extends('layout.master')

@section('title')
    Admin | Attributes
@endsection

@section('contents')
    <div class="row g-0">
        <div class="col-lg-12 pe-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <h5 class="mb-2 mb-md-0">Attribute Manager</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 pe-lg-2">
            <div class="card shadow-none">
                <div class="card-header bg-body-tertiary">
                    <h6 class="mb-0">List Attributes</h6>
                </div>
                <div class="card-body p-0 pb-3">
                    <div class="table-responsive scrollbar">
                        <table class="table mb-0">
                            <thead class="bg-200">
                                <tr>
                                    <th class="text-black dark__text-white align-middle" style="width: 200px;">Name</th>
                                    <th class="text-black dark__text-white align-middle">Attribute Value</th>
                                    <th class="text-black dark__text-white align-middle white-space-nowrap pe-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="align-middle">Color Attribute</th>
                                    <td class="align-middle">
                                        <div class="row">
                                            <div class="col-sm-4 mb-3 d-flex" id="valueID-12">
                                                <input type="color" class="form-control form-control-color" value=""
                                                    disabled>
                                                <a class="btn btn-danger">
                                                    <span class="far fa-trash-alt"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-info" href="">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="align-middle">Size Attribute</th>
                                    <td class="align-middle">
                                        <div class="row">
                                            <div class="col-sm-4 mb-3 d-flex" id="valueID-34">
                                                <input type="text" class="form-control" value="S" disabled>
                                                <a class="btn btn-danger">
                                                    <span class="far fa-trash-alt"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle white-space-nowrap text-end">
                                        <a class="btn btn-info" href="">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 ps-lg-2">
            <div class="sticky-sidebar">
                <form action="" class="card mb-3">
                    <div class="card-header bg-body-tertiary">
                        <h6 class="mb-0">Add Attribute Values</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gx-2">
                            <div class="col-12 mb-4">
                                <label class="form-label" for="price_default">Select Attribute:</label>
                                <select class="form-select" aria-label="Default select example" name="sltAttribute">
                                    <option value="nullSlt" selected>Null Select</option>
                                    <option value="color">Color Attribute</option>
                                    <option value="size">Size Attribute</option>
                                </select>
                            </div>
                            <div class="row gx-2 loadAttrValue"></div>
                            <div class="col-6 mb-3">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js-libs')
    <script src="{{ asset('theme/admin/vendors/jquery/jquery.min.js') }}"></script>
@endsection
