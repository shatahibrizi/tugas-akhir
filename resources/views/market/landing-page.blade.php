@extends('layouts.market-app')

@section('content')
  @include('layouts.navbars.market.topnav', ['title' => 'Product Table'])
  <!-- Hero Start -->
  <div class="container-fluid hero-header mb-2 py-5">
    <div class="container py-5">
      <div class="row g-5 align-items-center">
        <div class="col-md-12 col-lg-7">
          <h4 class="text-secondary mb-3">100% Organic Foods</h4>
          <h1 class="display-3 text-primary mb-5">Organic Veggies & Fruits Foods</h1>
          <div class="position-relative mx-auto">
            <input class="form-control border-secondary w-75 border-1 rounded-1 px-4 py-3" type="number"
              placeholder="Search" />
            <button type="submit"
              class="btn btn-primary border-secondary position-absolute h-100 rounded-end border-2 px-4 py-3 text-white"
              style="top: 0; right: 25%">
              Submit Now
            </button>
          </div>
        </div>
        <div class="col-md-12 col-lg-5">
          <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active rounded">
                <img src="{{ asset('markets/img/hero-img-1.png') }} " class="img-fluid w-100 h-100 bg-secondary rounded"
                  alt="First slide" />
                <a href="#" class="btn rounded px-4 py-2 text-white">Fruites</a>
              </div>
              <div class="carousel-item rounded">
                <img src="{{ asset('markets/img/hero-img-2.jpg') }} " class="img-fluid w-100 h-100 rounded"
                  alt="Second slide" />
                <a href="#" class="btn rounded px-4 py-2 text-white">Vesitables</a>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Hero End -->

  <!-- Featurs Section Start -->
  <div class="container-fluid featurs py-5">
    <div class="container py-5">
      <div class="row g-4">
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-car-side fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Free Shipping</h5>
              <p class="mb-0">Free on order over $300</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-user-shield fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>Security Payment</h5>
              <p class="mb-0">100% security payment</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fas fa-exchange-alt fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>30 Day Return</h5>
              <p class="mb-0">30 day money guarantee</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="featurs-item bg-light rounded p-4 text-center">
            <div class="featurs-icon btn-square rounded-circle bg-secondary mx-auto mb-5">
              <i class="fa fa-phone-alt fa-3x text-white"></i>
            </div>
            <div class="featurs-content text-center">
              <h5>24/7 Support</h5>
              <p class="mb-0">Support every time fast</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Featurs Section End -->

  <!-- Fruits Shop Start-->
  <div class="container-fluid fruite py-5">
    <div class="container py-5">
      <div class="tab-class text-center">
        <div class="row g-4">
          <div class="col-lg-4 text-start">
            <h1>Our Organic Products</h1>
          </div>
          <div class="col-lg-8 text-end">
            <ul class="nav nav-pills d-inline-flex mb-5 text-center">
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill active m-2 py-2" data-bs-toggle="pill" href="#tab-1">
                  <span class="text-dark" style="width: 130px">All Products</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill m-2 py-2" data-bs-toggle="pill" href="#tab-2">
                  <span class="text-dark" style="width: 130px">Vegetables</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill m-2 py-2" data-bs-toggle="pill" href="#tab-3">
                  <span class="text-dark" style="width: 130px">Fruits</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill m-2 py-2" data-bs-toggle="pill" href="#tab-4">
                  <span class="text-dark" style="width: 130px">Bread</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="d-flex bg-light rounded-pill m-2 py-2" data-bs-toggle="pill" href="#tab-5">
                  <span class="text-dark" style="width: 130px">Meat</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content">
          <div id="tab-1" class="tab-pane fade show active p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Grapes</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Grapes</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-2.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Raspberries</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-4.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Apricots</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-3.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Banana</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-1.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Oranges</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-2.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Raspberries</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Grapes</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-2" class="tab-pane fade show p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Grapes</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-2.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Raspberries</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-3" class="tab-pane fade show p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-1.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Oranges</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-6.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Apple</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-4" class="tab-pane fade show p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Grapes</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-4.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Apricots</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-5" class="tab-pane fade show p-0">
            <div class="row g-4">
              <div class="col-lg-12">
                <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-3.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Banana</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-2.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Raspberries</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="position-relative fruite-item rounded">
                      <div class="fruite-img">
                        <img src="{{ asset('markets/img/fruite-item-1.jpg') }} " class="img-fluid w-100 rounded-top"
                          alt="" />
                      </div>
                      <div class="bg-secondary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; left: 10px">
                        Fruits
                      </div>
                      <div class="border-secondary border-top-0 rounded-bottom border p-4">
                        <h4>Oranges</h4>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod
                          te incididunt
                        </p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                          <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                          <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                              class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Fruits Shop End-->

  <!-- Vesitable Shop Start-->
  <div class="container-fluid vesitable py-5">
    <div class="container py-5">
      <h1 class="mb-0">Fresh Organic Vegetables</h1>
      <div class="owl-carousel vegetable-carousel justify-content-center">
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-6.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Parsely</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-1.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Parsely</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-3.png') }} " class="img-fluid w-100 rounded-top bg-light"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Banana</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-4.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Bell Papper</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Potatoes</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-6.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Parsely</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-5.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Potatoes</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="border-primary position-relative vesitable-item rounded border">
          <div class="vesitable-img">
            <img src="{{ asset('markets/img/vegetable-item-6.jpg') }} " class="img-fluid w-100 rounded-top"
              alt="" />
          </div>
          <div class="bg-primary position-absolute rounded px-3 py-1 text-white" style="top: 10px; right: 10px">
            Vegetable
          </div>
          <div class="rounded-bottom p-4">
            <h4>Parsely</h4>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te incididunt
            </p>
            <div class="d-flex justify-content-between flex-lg-wrap">
              <p class="text-dark fs-5 fw-bold mb-0">$7.99 / kg</p>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Vesitable Shop End -->

  <!-- Banner Section Start-->
  <div class="container-fluid banner bg-secondary my-5">
    <div class="container py-5">
      <div class="row g-4 align-items-center">
        <div class="col-lg-6">
          <div class="py-4">
            <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
            <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
            <p class="text-dark mb-4">
              The generated Lorem Ipsum is therefore always free from repetition injected humour,
              or non-characteristic words etc.
            </p>
            <a href="#" class="banner-btn btn rounded-pill text-dark border-2 border-white px-5 py-3">BUY</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="position-relative">
            <img src="{{ asset('markets/img/baner-1.png') }} " class="img-fluid w-100 rounded" alt="" />
            <div class="d-flex align-items-center justify-content-center rounded-circle position-absolute bg-white"
              style="width: 140px; height: 140px; top: 0; left: 0">
              <h1 style="font-size: 100px">1</h1>
              <div class="d-flex flex-column">
                <span class="h2 mb-0">50$</span>
                <span class="h4 text-muted mb-0">kg</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner Section End -->

  <!-- Bestsaler Product Start -->
  <div class="container-fluid py-5">
    <div class="container py-5">
      <div class="mx-auto mb-5 text-center" style="max-width: 700px">
        <h1 class="display-4">Bestseller Products</h1>
        <p>
          Latin words, combined with a handful of model sentence structures, to generate Lorem
          Ipsum which looks reasonable.
        </p>
      </div>
      <div class="row g-4">
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-1.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-2.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-3.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-4.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-5.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xl-4">
          <div class="bg-light rounded p-4">
            <div class="row align-items-center">
              <div class="col-6">
                <img src="{{ asset('markets/img/best-product-6.jpg') }}" class="img-fluid rounded-circle w-100"
                  alt="" />
              </div>
              <div class="col-6">
                <a href="#" class="h5">Organic Tomato</a>
                <div class="d-flex my-3">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
                <h4 class="mb-3">3.12 $</h4>
                <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                    class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="text-center">
            <img src="{{ asset('markets/img/fruite-item-1.jpg') }} " class="img-fluid rounded" alt="" />
            <div class="py-4">
              <a href="#" class="h5">Organic Tomato</a>
              <div class="d-flex justify-content-center my-3">
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4 class="mb-3">3.12 $</h4>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="text-center">
            <img src="{{ asset('markets/img/fruite-item-2.jpg') }} " class="img-fluid rounded" alt="" />
            <div class="py-4">
              <a href="#" class="h5">Organic Tomato</a>
              <div class="d-flex justify-content-center my-3">
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4 class="mb-3">3.12 $</h4>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="text-center">
            <img src="{{ asset('markets/img/fruite-item-3.jpg') }} " class="img-fluid rounded" alt="" />
            <div class="py-4">
              <a href="#" class="h5">Organic Tomato</a>
              <div class="d-flex justify-content-center my-3">
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4 class="mb-3">3.12 $</h4>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-3">
          <div class="text-center">
            <img src="{{ asset('markets/img/fruite-item-4.jpg') }} " class="img-fluid rounded" alt="" />
            <div class="py-2">
              <a href="#" class="h5">Organic Tomato</a>
              <div class="d-flex justify-content-center my-3">
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star text-primary"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4 class="mb-3">3.12 $</h4>
              <a href="#" class="btn border-secondary rounded-pill text-primary border px-3"><i
                  class="fa fa-shopping-bag text-primary me-2"></i> Add to cart</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bestsaler Product End -->

  <!-- Fact Start -->
  <div class="container-fluid py-5">
    <div class="container">
      <div class="bg-light rounded p-5">
        <div class="row g-4 justify-content-center">
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>satisfied customers</h4>
              <h1>1963</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>quality of service</h4>
              <h1>99%</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>quality certificates</h4>
              <h1>33</h1>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="counter rounded bg-white p-5">
              <i class="fa fa-users text-secondary"></i>
              <h4>Available Products</h4>
              <h1>789</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Fact Start -->

  <!-- Tastimonial Start -->
  <div class="container-fluid testimonial py-5">
    <div class="container py-5">
      <div class="testimonial-header text-center">
        <h4 class="text-primary">Our Testimonial</h4>
        <h1 class="display-5 text-dark mb-5">Our Client Saying!</h1>
      </div>
      <div class="owl-carousel testimonial-carousel">
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="testimonial-item img-border-radius bg-light rounded p-4">
          <div class="position-relative">
            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0"></i>
            <div class="border-bottom border-secondary mb-4 pb-4">
              <p class="mb-0">
                Lorem Ipsum is simply dummy text of the printing Ipsum has been the industry's
                standard dummy text ever since the 1500s,
              </p>
            </div>
            <div class="d-flex align-items-center flex-nowrap">
              <div class="bg-secondary rounded">
                <img src="{{ asset('markets/img/testimonial-1.jpg') }} " class="img-fluid rounded"
                  style="width: 100px; height: 100px" alt="" />
              </div>
              <div class="d-block ms-4">
                <h4 class="text-dark">Client Name</h4>
                <p class="m-0 pb-3">Profession</p>
                <div class="d-flex pe-5">
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                  <i class="fas fa-star text-primary"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Tastimonial End -->
  @include('layouts.footers.market.footer')
@endsection
