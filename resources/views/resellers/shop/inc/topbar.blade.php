<div class="top-nav">
    <div class="container">
        <div class="top-nav-wrapper clearfix">
            <div class="top-nav-left pull-left">
                <ul class="list-inline">
                    <li>
                        <select class="top-nav-select custom-select-white" onchange="location = this.value">
                            <option value="https://fleetcart.envaysoft.com/en/current-currency/SAR" selected>
                                SAR
                            </option>
                            <option value="https://fleetcart.envaysoft.com/en/current-currency/USD">
                                USD
                            </option>
                        </select>
                    </li>

                    <li>
                        <select class="top-nav-select custom-select-white" onchange="location = this.value">
                            <option value="https://fleetcart.envaysoft.com/ar/products">
                                Arabic
                            </option>
                            <option value="https://fleetcart.envaysoft.com/en/products" selected>
                                English
                            </option>
                        </select>
                    </li>
                </ul>
            </div>

            <div class="top-nav-right pull-right">
                <ul class="list-inline">
                    <li><a href="https://fleetcart.envaysoft.com/en/contact">Contact</a></li>

                    <li>
                        <a href="https://fleetcart.envaysoft.com/en/compare">
                            Compare (0)
                        </a>
                    </li>

                    <li><a href="{{ route('reseller.home') }}">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>