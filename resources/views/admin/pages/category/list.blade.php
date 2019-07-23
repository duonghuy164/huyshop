@extends('admin.layout.master')
@section('title')
     Danh sach Category
@endsection


@section('content')
<div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Chỉnh sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($category as $key=>$value)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->slug }}</td>
                                            <td>
                                                @if($value->status==1)
                                                {{ " Hien thi" }}
                                                @else
                                                {{ "khong hien thi" }}
                                                @endif
                                            </td> 
                                            <td>
                                                <button class="btn btn-primary edit" title="{{ "Sửa ".$value->name }}" data-toggle="modal" data-target="#edit" type="button" data-id="{{      $value->id }}"><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-danger delete" title="{{ "Xóa ".$value->name }}" data-toggle="modal" data-target="#delete" type="button" data-id="{{   $value->id }}"><i class="fas fa-trash-alt"></i></button>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="pull-right">{{ $category->links() }}</div>
                            </div>
                        </div>
                    </div>
    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa:<span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">
                        <div class="col-lg-12">
                            <form role="form" >
                                
                                <fieldset class="form-group">
                                    <label>Chỉnh Sửa </label>
                                    <input class="form-control name" name="name" >
                                    <span class="error" style="color:green ;font-size: 1rem; "></span>
                                </fieldset>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control status" name="status">
                                        <option value="1" class="ht">Hiển Thị</option>
                                        <option value="0" class="kht">Không Hiển Thị</option>
                                    </select>
                                </div>
                                
                            </form>
                       </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success update">Save</button>
                    <button type="reset" class="btn btn-primary ">Làm Lại</button>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- delete Modal-->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 183px;">
                    <button type="button" class="btn btn-success del">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                <div>
            </div>
        </div>
    </div>

@endsection