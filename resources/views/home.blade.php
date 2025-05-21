@extends('master.index')
@section('title', 'Dashboard')
@section('content')
<div class="content-wrapper">
  <!-- Content -->

  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Congratulations {{auth()->user()->name}}! 🎉</h5>
                
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="{{asset('asset/assets/img/illustrations/man-with-laptop-light.png')}}"
                  height="140"
                  alt="View Badge User"
                  data-app-dark-img="illustrations/man-with-laptop-dark.png"
                  data-app-light-img="illustrations/man-with-laptop-light.png"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('asset/assets/img/icons/unicons/chart-success.png')}}"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt3"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Total Student</span>
                <h3 class="card-title mb-2">{{$student}}</h3>
                
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{asset('asset/assets/img/icons/unicons/wallet-info.png')}}"
                      alt="Credit Card"
                      class="rounded"
                    />
                  </div>
                  <div class="dropdown">
                    <button
                      class="btn p-0"
                      type="button"
                      id="cardOpt6"
                      data-bs-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      
                    </div>
                  </div>
                </div>
                <span>Certificate</span>
                <h3 class="card-title text-nowrap mb-1">{{$certificate}}</h3>
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
     
      </div>
      <!--/ Transactions -->
    </div>
  </div>
  <!-- / Content -->

 
@endsection