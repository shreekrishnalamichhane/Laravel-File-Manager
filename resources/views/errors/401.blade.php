@extends('layouts.guest')

@section('contents')
    <div class="container py-5 mb-lg-3">
        <div class="row justify-content-center pt-lg-4 text-center">
            <div class="col-lg-5 col-md-7 col-sm-9">
                <h1 class="display-404 py-lg-3">401</h1>
                <h2 class="h3 mb-4">You are unauthorized to be here.</h2>
                <p class="fs-md mb-4">
                    <u>Here are some helpful links instead:</u>
                </p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <div class="row">
                    <div class="col-sm-6 mb-3"><a class="card h-100 border-0 shadow-sm" href="/">
                            <div class="card-body">
                                <div class="d-flex align-items-center"><i class="ci-home text-primary h4 mb-0"></i>
                                    <div class="ps-3">
                                        <h5 class="fs-sm mb-0">Homepage</h5><span class="text-muted fs-ms">Return to
                                            homepage</span>
                                    </div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 mb-3"><a class="card h-100 border-0 shadow-sm" href="#">
                            <div class="card-body" data-bs-toggle="collapse" data-bs-target="#searchBox" role="button"
                                aria-expanded="false" aria-controls="searchBox">
                                <div class="d-flex align-items-center"><i class="ci-search text-success h4 mb-0"></i>
                                    <div class="ps-3">
                                        <h5 class="fs-sm mb-0">Search</h5><span class="text-muted fs-ms">Find with advanced
                                            search</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
