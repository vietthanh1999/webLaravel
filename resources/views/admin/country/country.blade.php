@extends('admin.layouts.app')
@section('content')
<!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Product Table</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Basic Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                                <td><a href="">Edit</a>|<a href="">Delete</a></td>

                                            </tr> --}}
                                            @foreach($country as $ct)
                                            <tr class="odd gradeX">
                                                <td>{{$ct->id}}</td>
                                                <td>{{$ct->name}}</td>

                                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ URL::asset('country/delete/' .$ct->id)}}"> Delete</a>|<i class="fa fa-pencil fa-fw"></i> <a href="{{ URL::asset('country/edit/' .$ct->id)}}">Edit</a></td>

                                                {{-- <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/product/sua/{{$ct->id}}">Edit</a></td> --}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->

                <!-- End Right sidebar -->
                <!-- ============================================================== -->
                <button type="button" class="btn btn-success"><a href="country/add">Add</button>

            </div>

            <!-- ============================================================== -->
            <!-- End Container fluid  -->
@endsection

