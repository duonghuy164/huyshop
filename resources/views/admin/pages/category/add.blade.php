@extends('admin.layout.master')
@section('title')
  Thêm Sản Phẩm

@endsection


@section('content')

<div class="col-lg-12">
							        <form role="form" action="{{ route('category.store') }}" method="post">
							        	@csrf
							            <fieldset class="form-group">
							                <label>Name</label>
							                <input name="name" class="form-control" placeholder="Nhập Tên Category">
							            </fieldset>
							           
							            <div class="form-group">
							                <label>Status</label>
							                <select class="form-control" name="status">
							                    <option value="1">Hien thi</option>
							                    <option value="0">Khong hien thi</option>
							                  
							                </select>
							            </div>
							            <button type="submit" class="btn btn-success">Submit Button</button>
							            <button type="reset" class="btn btn-primary">Reset Button</button>
							        </form>
							    </div>

@endsection