@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="card card-success">
                  <div class="card-header">
                    <h4>List</h4>
                  </div>
                  <div class="card-body">
                    <ul class="list-unstyled">
                      <li class="media">
                        <img class="mr-3" src="{{ asset('assets/img/image-64.png')}}" alt="Generic placeholder image">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">List-based media object</h5>
                          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                            Cras purus oringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                      </li>
                      <li class="media my-4">
                        <img class="mr-3" src="{{ asset('assets/img/image-64.png')}}" alt="Generic placeholder image">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">List-based media object</h5>
                          <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.
                            Cras purus oringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                      </li>
                      <li class="media">
                        <img class="mr-3" src="{{ asset('assets/img/image-64.png')}}" alt="Generic placeholder image">
                        <div class="media-body">
                          <h5 class="mt-0 mb-1">List-based media object</h5>
                          <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                            sollicitudin. Cras purus oringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection