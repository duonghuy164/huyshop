<div class="navbar-inner">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="agileits-navi_search">
					<form action="#" method="post">
						<select id="agileinfo-nav_search" name="agileinfo_search" class="border" required="">
							<option value="">All Categories</option>
							@foreach($categoryall as $cat )
							<option value="{{ $cat->id }}">{{ $cat->name }}</option>}
							
							@endforeach
						</select>
					</form>
				</div>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
				    aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto text-center mr-xl-5">
						<li class="nav-item active mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link" href="/">Home
								<span class="sr-only">(current)</span>
							</a>
						</li>

						@foreach($category as $cat)
						<li class="nav-item dropdown mr-lg-2 mb-lg-0 mb-2">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{ $cat->name }}
							</a>
							<div class="dropdown-menu">
								<div class="agile_inner_drop_nav_info p-4">
									<h5 class="mb-3">{{ $cat->name }}</h5>
									<div class="row">
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">


												@foreach($cat->productType as $pt)
												
												<li>
													<a href="product.html">{{ $pt->name }}</a>
												</li>
												
												@endforeach
											</ul>
										</div>
										<div class="col-sm-6 multi-gd-img">
											<ul class="multi-column-dropdown">
												<li>
													<a href="product.html">Mức giá</a>
												</li>
												<li>
													<a href="product.html">Dưới 2 triệu</a>
												</li>
												<li>
													<a href="product.html">Từ 2 đến 5 triệu</a>
												</li>
												<li>
													<a href="product.html">Từ 5 đến 10 triệu</a>
												</li>
												<li>
													<a href="product.html">Từ 10 đến 15 triệu</a>
												</li>
												<li>
													<a href="product.html">Từ 15 đến 20 triệu</a>
												</li>
												<li>
													<a href="product.html">Từ 2 triệu đổ lên </a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</li>
						@endforeach
						
							<a class="nav-link" href="contact.html">Contact Us</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>