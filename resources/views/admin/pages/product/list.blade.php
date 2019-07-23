@extends('admin.layout.master')
@section('title')
    Danh sách loại sản phẩm
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Loại Sản Phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Name</th>
                            <th>Mô tả</th>
                            <th>Thông tin</th>
                            <th>Danh mục sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Status</th>
                            <th>Chỉnh sửa</th>
                        </tr>
                    </thead>
                   
                    <tbody>
                        @foreach($product as $key => $value)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->description }}</td>
                                <td>
                                   <b>Số Lượng:</b>:{{ $value->quantity }} 
                                   <br>
                                    <b>Đơn Giá</b>:{{ $value->price }}
                                    <br>
                                    <b>Khuyến mại </b>:{{ $value->promotinal }}
                                    <br>
                                    <b>Hình ảnn</b>:<img src="img/upload/product/{{ $value->image }}" width="100" height="100">
                                </td>

                                <td>{{ $value->category->name }}</td>
                                  {{-- tren ko sao ma duoi lai bi loi vcc --}}
                                 <td>{{ $value->productType['name'] }}</td>
                                <td>
                                    @if($value->status==1)
                                    
                                        {{ "Hiển thị" }}
                                    @else
                                    {{ "Không hiển thị" }}
                                    @endif


                                </td>

                                <td>
                                    <button class="btn btn-primary editProduct" title="{{ "Sửa ".$value->name }}" data-toggle="modal" data-target="#edit" type="button" data-id="{{ $value->id }}"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger deleteProduct" title="{{ "Xóa ".$value->name }}" data-toggle="modal" data-target="#delete" type="button" data-id="{{ $value->id }}"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pull-right">{{ $product->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Edit Modal-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa Producttype <span class="title"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 5px">

                        <div class="col-lg-12">
        <form role="form" id="updateProduct"  method="post" enctype="multipart/form-data">
                    
                    <fieldset class="form-group">
                        <label>Tên sản phẩm</label>
                        <input class="form-control name" name="name" placeholder="Nhập tênsản phẩm">
                        <div class="alert alert-danger errorName name"></div>
                    </fieldset>
                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="quantity" min="1" class="form-control quantity" value="1">
                        <div class="alert alert-danger errorQuantity "></div>
                    </div>
                     <div class="form-group">
                        <label for="">Đơn giá</label>
                        <input type="text" name="price" placeholder="Nhập đơn giá " class="form-control price">
                        <div class="alert alert-danger errorPrice"></div>
                    </div>
                     <div class="form-group">
                        <label for="">Khuyến mại</label>
                        <input type="number" name="promotinal" placeholder="Nhập khuyến mại nếu có " value="0"class="form-control promotinal">
                       <div class="alert alert-danger errorPromotinal"></div>
                    </div>
                    <img src="" alt="" class="img img-thumbnail imageThum " width="100" height="100" ligh="center">

                    <div class="form-group">
                        <label for="">Hình Ảnh</label>
                        <input type="file" name="image" class="form-control">
                      <div class="alert alert-danger errorImage image"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả sản phẩm</label>
                        <textarea name="description" id="demo" cols="5" rows="5" class="form-control ckeditor description"></textarea>
                        
                    </div>

                    <div class="form-group">
                        <label>Danh mục sản phẩm</label>
                        <select class="form-control cateProduct" name="idCategory">
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select class="form-control proTypeProduct" name="idProductType">
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control status" name="status">
                            <option value="1" class="ht">Hiển Thị</option>
                            <option value="0" class="kht">Không Hiển Thị</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-success" value="Sửa">
                    <button type="reset" class="btn btn-primary">Nhập Lại</button>
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        </form>
                        </div>
                    </div>
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
                    <button type="button" class="btn btn-success delProduct">Có</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Không</button>
                <div>
            </div>
        </div>
    </div>
@endsection