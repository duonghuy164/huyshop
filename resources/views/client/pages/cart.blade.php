@extends('client.layout.master')


@section('title')
       Giỏ Hàng 
@endsection

@section('content')
<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="/">Trang chủ</a>
						<i>|</i>
					</li>
					<li>Checkout</li>
				</ul>
			</div>
		</div>
	</div>
<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ Hàng của {{ Auth::user()->name }}
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<h4 class="mb-sm-4 mb-3">Giỏ hàng có:
					<span>{{ Cart::count() }} sản phẩm</span>
				</h4>
				<div class="table-responsive">
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Số thứ tự</th>
								
								<th>Hình ảnh</th>
								<th>Tên Sản phẩm </th>
								<th>Số lương</th>

								<th>Price</th>
								<th>Chỉnh sửa</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=1;  ?>
							@foreach($cart as $value)
							<tr class="rem1">
								<td class="invert">{{ $i}}</td>
								<td class="invert-image">
									<a href="single.html">
										<img src="img/upload/product/{{ $value->options->img }}" alt="{{ $value->name }} " class="img-responsive">
									</a>
								</td>
								<td class="invert">{{ $value->name }}</td>
								<td class="invert">

									<div class="quantity">
										<form class="form" >
											<div class="form-group">
												<input type="hidden" name="row_id" class="row_id form-control" value="{{ $value->rowId }}">
											   <input type="number" name="qty" class="qty form-control" value="{{ $value->qty }}"  data-id="{{ $value->rowId }}">
												
											</div>
											
										</form>
									</div>
								</td>
							
								<td class="invert">{{ $value->price }}</td>
								<td class="invert">
									<div class="rem">
										<div class="close1" data-id="{{ $value->rowId }}" > </div>
									</div>
								</td>
							</tr>
							<?php $i++?>
							@endforeach
						</tbody>
					</table>
					<h4 class="mb-sm-4 mb-3" align="right">Số tiền tổng cộng là 
					<span>{{ Cart::total() }}</span>
					</h4>

				</div>
			</div>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					
					
					<div class="checkout-right-basket">
						<a href="{{ route('checkout') }}">Make a Payment
							<span class="far fa-hand-point-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection