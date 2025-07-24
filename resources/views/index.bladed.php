@extends('layout.app')
@section('content')
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('layout.navbar')
        <!-- Navbar End -->


        <!--logo Start -->
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/img/bg.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: blue(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">




                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/img/bgg.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: blue(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <div class="row g-2">
                <div class="col-md-10">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-0" placeholder="Keyword" />
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0">
                                <option selected>Job Grade</option>
                                <option value="1">Grade 1</option>
                                <option value="2">Grade 2</option>
                                <option value="3">Grade 3</option>
                                <option value="1">Grade 4</option>
                                <option value="2">Grade 5</option>
                                <option value="3">Grade 6</option>
                                <option value="1">Grade 7</option>
                                <option value="2">Grade 8</option>
                                <option value="3">Grade 9</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                           <select class="form-select border-0" name="county">
    <option selected disabled>Location</option>
    <option value="Mombasa">Mombasa</option>
    <option value="Kwale">Kwale</option>
    <option value="Kilifi">Kilifi</option>
    <option value="Tana River">Tana River</option>
    <option value="Lamu">Lamu</option>
    <option value="Taita-Taveta">Taita-Taveta</option>
    <option value="Garissa">Garissa</option>
    <option value="Wajir">Wajir</option>
    <option value="Mandera">Mandera</option>
    <option value="Marsabit">Marsabit</option>
    <option value="Isiolo">Isiolo</option>
    <option value="Meru">Meru</option>
    <option value="Tharaka-Nithi">Tharaka-Nithi</option>
    <option value="Embu">Embu</option>
    <option value="Kitui">Kitui</option>
    <option value="Machakos">Machakos</option>
    <option value="Makueni">Makueni</option>
    <option value="Nyandarua">Nyandarua</option>
    <option value="Nyeri">Nyeri</option>
    <option value="Kirinyaga">Kirinyaga</option>
    <option value="Murang'a">Murang'a</option>
    <option value="Kiambu">Kiambu</option>
    <option value="Turkana">Turkana</option>
    <option value="West Pokot">West Pokot</option>
    <option value="Samburu">Samburu</option>
    <option value="Trans-Nzoia">Trans-Nzoia</option>
    <option value="Uasin Gishu">Uasin Gishu</option>
    <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
    <option value="Nandi">Nandi</option>
    <option value="Baringo">Baringo</option>
    <option value="Laikipia">Laikipia</option>
    <option value="Nakuru">Nakuru</option>
    <option value="Narok">Narok</option>
    <option value="Kajiado">Kajiado</option>
    <option value="Kericho">Kericho</option>
    <option value="Bomet">Bomet</option>
    <option value="Kakamega">Kakamega</option>
    <option value="Vihiga">Vihiga</option>
    <option value="Bungoma">Bungoma</option>
    <option value="Busia">Busia</option>
    <option value="Siaya">Siaya</option>
    <option value="Kisumu">Kisumu</option>
    <option value="Homa Bay">Homa Bay</option>
    <option value="Migori">Migori</option>
    <option value="Kisii">Kisii</option>
    <option value="Nyamira">Nyamira</option>
    <option value="Nairobi">Nairobi</option>
</select>

                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-dark border-0 w-100">Search</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Search End -->


    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Open Vacancy</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">


                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                            <h6 class="mt-n1 mb-0">Permanent</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                            <h6 class="mt-n1 mb-0">Internship</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Human Resource</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Westland</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="form1.html">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Supply Chain Management</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kitale</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="pro.html">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Clerical officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Eldoret</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="pro.html">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Registration Officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Nakuru</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                      
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="form1.html">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                      <h5 class="mb-3">Driver</h5>

                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP,
                                            Nyahururu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                        
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">ICT</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Head
                                            OFFICE</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                        
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Clerical Officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Head
                                            Office</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Compliance officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kisumu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 May,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Supply Chain Managemnt Officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Mombasa</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="form1.html">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">

                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kisumu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                     
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">ICT</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kitale</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                        
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Human resource officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kitale</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Compliance officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kisumu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Corporate communication officer</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kisumu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 April,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded"
                                        src="{{ asset('assets/img/images.png') }}" alt=""
                                        style="width: 80px; height: 80px;">
                                    <div class="text-start ps-4">
                                        <h5 class="mb-3">Driver</h5>
                                        <span class="text-truncate me-3"><i
                                                class="fa fa-map-marker-alt text-primary me-2"></i>ORPP, Kisumu</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full
                                            Time</span>
                                       
                                    </div>
                                </div>
                                <div
                                    class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <a class="btn btn-light btn-square me-3" href=""><i
                                                class="far fa-heart text-primary"></i></a>
                                        <a class="btn btn-primary" href="">Apply Now</a>
                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date
                                        Line: 01 June,
                                        2025</small>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="text-center mb-5">Our Administration</h1>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-light rounded p-4">


                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/reg.jpg') }}"
                            style="width: 150px; height: 100px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Anne Nderitu CBS</h5>
                            <small>Registrar</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">


                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/ass.jpg') }}"
                            style="width: 150px; height: 100px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Mr Ali</h5>
                            <small>Ass Registrar</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">


                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ asset('assets/img/flor.jpg') }}"
                            style="width: 150px; height: 100px;">
                        <div class="ps-3">
                            <h5 class="mb-1">CPA Florence Birya</h5>
                            <small>Ass Registrar</small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Quick Links</h5>
                    <a class="btn btn-link text-white-50" href="">Political Parties Liaison</a>
                    <a class="btn btn-link text-white-50" href="">Committee</a>
                    <a class="btn btn-link text-white-50" href="">Research Centre - OPAC</a>
                    <a class="btn btn-link text-white-50" href="">Downloads</a>
                    <a class="btn btn-link text-white-50" href="">FAQS</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Related Links</h5>
                    <a class="btn btn-link text-white-50" href="">Kenya Vision 2030</a>
                    <a class="btn btn-link text-white-50" href="">Independent Electoral and Boundaries Commission</a>
                    <a class="btn btn-link text-white-50" href="">National Treasury</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Contact</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>1131-00606, Waiyaki Way, Nairobi</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+254(0)204039888</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@orpp.or.ke</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <p>Subscribe for newsletter</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">ORPP Kenya 2025</a>, All Right Reserved.

                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

@endsection