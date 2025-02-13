@extends('userLayout')
@section('content')
    <div class="home-content">
        <div class="home-content-text">
            <h2 class="home-content-title"> Your Best <span class="color">Logistics</span> Partner!</h2>
            <h3 class="home-content-body">Best Courier Services </h3>
            <h3 class="home-content-body">in Pakistan</h3>
            <a href="{{ route('freightBooking')}}" ><button class="book-now-btn">Book Now</button></a>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-uppercase" class="color" >Our Services</h6>
                <h1 class="mb-5">Explore Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ URL('images\service-1.jpg')}}" alt="">
                        </div>
                        <h4 class="mb-3">Air Freight</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="{{ route('freightBooking')}}"><i class="fa fa-arrow-right"></i><span>Book Now</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ URL('images\service-2.jpg')}}" alt="">
                        </div>
                        <h4 class="mb-3">Ocean Freight</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="{{ route('freightBooking')}}"><i class="fa fa-arrow-right"></i><span>Book Now</span></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item p-4">
                        <div class="overflow-hidden mb-4">
                            <img class="img-fluid" src="{{ URL('images\service-3.jpg')}}" alt="">
                        </div>
                        <h4 class="mb-3">Road Freight</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="btn-slide mt-2" href="{{ route('freightBooking')}}"><i class="fa fa-arrow-right"></i><span>Book Now</span></a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="container-xxl py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow ">
                    <h6 class="text-uppercase mb-3 color">Some Facts</h6>
                    <h1 class="mb-5">#1 Place To Manage All Of Your Shipments</h1>
                    <p class="mb-5">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
                        eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
                    </p>
                    <div class="d-flex align-items-center">
                        <i class="fa fa-headphones fa-2x flex-shrink-0 p-3 text-white"
                            style="background-color: red;"></i>
                        <div class="ps-4">
                            <h6>Call for any query!</h6>
                            <h3 class="m-0" class="color">+012 345 6789</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-sm-6">
                            <div class="p-4 mb-4 wow " style="background-color: red;">
                                <i class="fa fa-users fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Happy Clients</p>
                            </div>
                            <div class="bg-secondary p-4 wow fadeIn" data-wow-delay="0.5s">
                                <i class="fa fa-ship fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Complete Shipments</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="bg-success p-4 wow fadeIn" data-wow-delay="0.7s">
                                <i class="fa fa-star fa-2x text-white mb-3"></i>
                                <h2 class="text-white mb-2" data-toggle="counter-up">1234</h2>
                                <p class="text-white mb-0">Customer Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid overflow-hidden py-5 px-lg-0">
        <div class="container feature py-5 px-lg-0">
            <div class="row g-5 mx-lg-0">
                <div class="col-lg-6 feature-text wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="text-uppercase mb-3 color">Our Features</h6>
                    <h1 class="mb-5">We Are Trusted Logistics Company Since 1990</h1>
                    <div class="d-flex mb-5 wow fadeInUp" data-wow-delay="0.3s">
                        <i class="fa fa-globe fa-3x flex-shrink-0" style="color:red"></i>

                        <div class="ms-4">
                            <h5>Worldwide Service</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo
                                justo magna erat amet</p>
                        </div>
                    </div>
                    <div class="d-flex mb-5 wow fadeIn" data-wow-delay="0.5s">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor"
                            class="bi bi-truck" viewBox="0 0 16 16" style="color: red">
                            <path
                                d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                        </svg>
                        <div class="ms-4">
                            <h5>On Time Delivery</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo
                                justo magna erat amet</p>
                        </div>
                    </div>
                    <div class="d-flex mb-0 wow fadeInUp" data-wow-delay="0.7s">
                        <i class="fa fa-headphones  fa-3x flex-shrink-0" style="color:red"></i>
                        <div class="ms-4">
                            <h5>24/7 Telephone Support</h5>
                            <p class="mb-0">Diam dolor ipsum sit amet eos erat ipsum lorem sed stet lorem sit clita duo
                                justo magna erat amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeInRight" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ URL('images\feature.jpg')}}"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-content-3">
        <div class="home-content-3-image">
            <div class="home-content-3-image-box">

            </div>
        </div>
        <div class="home-content-3-text">
            <div>
                <h2>We are a leader in logistics service</h2>
                <p>Presentations are communication tools that can be used as lectures, speeches, reports, and more. It
                    all
                    depends on the purpose of your presentation, and how you plan to arrange the details.</p>
            </div>

        </div>
    </div>
    <footer class="footer-distributed">
        <div class="footer-left">
            <h3>Online<span> Logistics System</span></h3>
            <p class="footer-links">
                <a href="index.php" class="link-1">Home</a>
                <a href="book-freights.php">Book Freight</a>
                <a href="trackshipments.php">Track Shipment</a>
                <a href="contactus.php">Contact us</a>
            </p>
            <p class="footer-company-name">Online Logistics System © 2024</p>
        </div>
        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p>123 ABC</p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p>123-456-789</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="#">hello@onlinelogisticssytem.com</a></p>
            </div>
        </div>
        <div class="footer-right">
            <p class="footer-company-about">
                <span>About the company</span>
                At our delivery services, we take pride in ensuring a seamless experience for our valued customers.
            </p>
            <div class="footer-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>
            </div>
        </div>
    </footer>
@endsection
