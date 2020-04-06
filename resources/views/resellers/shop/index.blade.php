@extends('resellers.shop.layout')

@section('content')
<div class="product-list-header clearfix">
    <div class="search-result-title pull-left">
        <h3>Shop</h3>

        <span>51 products found</span>
    </div>

    <div class="search-result-right pull-right">

        <div class="form-group">
            <select class="custom-select-black" onchange="location = this.value">
                <option value="https://fleetcart.envaysoft.com/en/products?sort=relevance">
                    Relevance
                </option>

                <option value="https://fleetcart.envaysoft.com/en/products?sort=alphabetic">
                    Alphabetic
                </option>

                <option value="https://fleetcart.envaysoft.com/en/products?sort=topRated">
                    Top Rated
                </option>

                <option value="https://fleetcart.envaysoft.com/en/products?sort=latest" selected>
                    Latest
                </option>

                <option value="https://fleetcart.envaysoft.com/en/products?sort=priceLowToHigh">
                    Price: Low to High
                </option>

                <option value="https://fleetcart.envaysoft.com/en/products?sort=priceHighToLow">
                    Price: High to Low
                </option>
            </select>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<div class="product-list-result clearfix">
    <div class="tab-content">
        <div id="grid-view" class="tab-pane active">
            <div class="row">
                <div class="grid-products separator">
                    @for($i = 1; $i <= 20; $i++)
                    <a href="https://fleetcart.envaysoft.com/en/products/samsung-galaxy-tab-active-2"
                        class="product-card">
                        <div class="product-card-inner">
                            <div class="product-image clearfix">
                                <ul class="product-ribbon list-inline">


                                </ul>

                                <div class="image-holder">
                                    <img src="https://fleetcart.envaysoft.com/storage/media/ieaRDnJgWqOBvGNrcUoRWBcsqXtBrpWIckKo7sWl.jpeg"
                                        alt="Samsung Galaxy Tab Active 2">
                                </div>

                                <div class="quick-view-wrapper" data-toggle="tooltip" data-placement="top"
                                    title="Quick View">
                                    <button type="button" class="btn btn-quick-view"
                                        data-slug="samsung-galaxy-tab-active-2">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="product-content clearfix">
                                <span class="product-price">SAR 1,428.75</span>
                                <span class="product-name">Samsung Galaxy Tab Active
                                    2</span>
                            </div>

                            <div class="add-to-actions-wrapper">
                                

                                <form method="POST" action="https://fleetcart.envaysoft.com/en/compare">
                                    <input type="hidden" name="_token" value="0jWtgNhwS6A9wjmUanUEK9MzhovCFNpSCaaA39m3">

                                    <input type="hidden" name="product_id" value="59">

                                    <button type="submit" class="btn btn-default btn-add-to-cart">
                                        Add To Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>
        </div>

        <div id="list-view" class="tab-pane ">
        </div>
    </div>
</div>

<div class="pull-right">
    <nav>
        <ul class="pagination">

            <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>





            <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
            <li class="page-item"><a class="page-link"
                    href="https://fleetcart.envaysoft.com/en/products?sort=latest&amp;page=2">2</a>
            </li>
            <li class="page-item"><a class="page-link"
                    href="https://fleetcart.envaysoft.com/en/products?sort=latest&amp;page=3">3</a>
            </li>
            <li class="page-item"><a class="page-link"
                    href="https://fleetcart.envaysoft.com/en/products?sort=latest&amp;page=4">4</a>
            </li>


            <li class="page-item">
                <a class="page-link" href="https://fleetcart.envaysoft.com/en/products?sort=latest&amp;page=2"
                    rel="next" aria-label="pagination.next">&rsaquo;</a>
            </li>
        </ul>
    </nav>

</div>
@endsection