@extends('layouts.main')

@section('title', 'Shop')

@section('content')
<section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Product</h3>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                       <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach($categories as $category)
                                <li>
                                    <a href="#">{{ $category->name }}</a>
                                    <span>({{ $category->products->count() }})</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget range">
                            <h3>Price Range</h3>
                            <input type="range" class="form-range" name="range" step="1" min="100" max="10000" value="10" onchange="rangePrimary.value=value">
                            <div class="range-inner">
                                <label>$</label>
                                <input type="text" id="rangePrimary" placeholder="100">
                            </div>
                        </div>
                     
                    </div>
                    <!-- End Product Sidebar -->
                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select class="form-control" id="sorting">
                                            <option>Popularity</option>
                                            <option>Low - High Price</option>
                                            <option>High - Low Price</option>
                                            <option>A - Z Order</option>
                                            <option>Z - A Order</option>
                                        </select>
                                        <h3 class="total-show-product">Showing: <span>1 - 12 items</span></h3>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" aria-controls="nav-grid" aria-selected="true"><i class="lni lni-grid-alt"></i></button>
                                           
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">
                                                            <div class="row">
                                    @foreach($products as $product)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="single-product">
                                            <div class="product-image">
                                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                                                <div class="button">
                                                  <a href="{{ route('customer.product.show', $product->id) }}" class="btn">
                                                        <i class="lni lni-cart"></i> Product Details
                                                    </a>

                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <span class="category">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                                <h4 class="title">
                                                    <a href="#">{{ $product->name }}</a>
                                                </h4>
                                                <div class="price">
                                                    <span>${{ number_format($product->price, 2) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                              <div class="row">
                                    <div class="col-12">
                                        <div class="pagination left">
                                            {{ $products->links() }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
