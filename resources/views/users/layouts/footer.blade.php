<!-- Footer Start -->
<div class="footer">
    <div class="container">
        <div class="footer_top">
            <div class="span_of_4">
                <div class="col-md-3 span1_of_4">
                    <h4>Shop</h4>
                    <ul class="f_nav">
                        <li v-for="category in categories">
                            <a v-bind:href="'/category/' + category.id + '/products'">@{{ category.title }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 span1_of_4">
                    <h4>help</h4>
                    <ul class="f_nav">
                        <li><a href="#">frequently asked  questions</a></li>
                        <li><a href="{{ route('terms') }}">Terms and Conditions</a></li>
                        <li><a href="{{ route('eshop.contact') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 span1_of_4">
                    <h4>account</h4>
                    <ul class="f_nav">
                        <li><a href="{{ route('login') }}">login</a></li>
                        <li><a href="{{ route('register') }}">create an account</a></li>
                        <li><a href="#">My Purchases</a></li>
                        <li><a href="{{ route('profile.setting') }}">Profile Setting</a></li>
                    </ul>
                </div>
                <div class="col-md-3 span1_of_4">
                    <h4>Contact Information</h4>
                    <ul class="f_nav">
                        <li><a href="{{ route('homepage') }}">{{ $setting->sitename  }}</a></li>
                        <li><a href="{{ $setting->email }}">{{ $setting->email }}</a></li>
                        <li><a href="javascript:void(0)">Phone: {{ $setting->phone }}</a></li>
                        <li><a href="javascript:void(0)">Address: {{ $setting->address }}</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <br><br><br>
        <div class="copyright text-center">
            <span class="footer-social">
                <a href=""><i class="ion ion-social-facebook-outline"></i></a>
                <a href=""><i class="ion ion-social-twitter-outline"></i></a>
                <a href=""><i class="ion ion-social-googleplus-outline"></i></a>
            </span>
            <p>&copy; 2017 <a href="{{ route('homepage') }}">{{ $setting->sitename }}</a>. All Rights Reserved </p>
        </div>
    </div>
</div>