<section class="footer bg-light pt-3">
    <div class="container p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row border-bottom">
                    <div class="col-md-4">
                        <div class="text-center pb-4">
                            <img src="{{asset('client')}}/img/logo.png" alt="" srcset="">
                        </div>
                        <p class="text-secondary">
                            Pet Zone BD is an online pet shop in Dhaka providing your loving pets with their
                            favourite foods and other accessories. We home deliver your pet food so you can
                            receive from your doorstep.
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-uppercase fw-bolder pb-4">CATEGORIES</h6>
                        <div>
                            @foreach($categories as $category)
                                <a class="d-block py-2 text-secondary" href="{{route('products', ['id'=>$category->id])}}">{{$category->name}}</a>
                            @endforeach
{{--                            <a class="d-block py-2 text-secondary" href="#"> Cat Food</a>--}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6 class="text-uppercase fw-bolder pb-4">QUICK LINKS</h6>
                        <div>
                            <a class="d-block py-2 text-secondary" href="#"> Home </a>
                            <a class="d-block py-2 text-secondary" href="#"> About Us</a>
                            <a class="d-block py-2 text-secondary" href="#"> Contact</a>
                            <a class="d-block py-2 text-secondary" href="#"> Blog</a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h6 class="text-uppercase fw-bolder pb-4">Contact</h6>
                        <div class="d-block">
                            <div>
                                <i class="fa-solid fa-house"></i> <a class=" py-2 ps-2 text-secondary" href="#">
                                    Dhaka, Bangladesh </a>
                            </div>
                            <div>
                                <i class="fa-solid fa-envelope"></i> <a class=" py-2 ps-2 text-secondary"
                                                                        href="#">
                                    petzonebd@gmail.com</a>
                            </div>
                            <div>
                                <i class="fa-solid fa-square-phone"></i> <a class=" py-2 ps-2 text-secondary"
                                                                            href="#"> 01700000000</a>
                            </div>
                            <a class="icon" href=""><i class="fa-brands fa-facebook"></i></a>
                            <a class="icon" href=""><i class="fa-brands fa-twitter"></i></a>
                            <a class="icon" href=""><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <p class="pt-4">
                    © 2022 PetZone BD. All Rights Reserved. Designed by
                    <a href="#"> Arafat Hossain Ar</a>
                </p>
            </div>
        </div>
    </div>
</section>
