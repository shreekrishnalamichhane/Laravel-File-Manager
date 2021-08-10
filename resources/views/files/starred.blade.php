@extends('layouts.user')

@section('scripts')

    <script>
        var clipboardLink = new ClipboardJS('[data-clipboard-text]');
        clipboardLink.on('success', function(e) {
            notify('Notification', 'Link Copied to Clipboard !', '', '', 'success');
        });
        clipboardLink.on('error', function(e) {
            notify('Error Message', 'Link Copy Failed !', '', '', 'danger');
        });

        function toggleFileStarred(slugName) {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            fetch("api/files/toggleFileStarred", { //url is provided as the parameter in the function.
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        slug: slugName
                    }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrf,
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => response.json())
                .then((d) => {
                    console.log(d);
                    if (d.success == 1) { //if the request returns with success = 1 i.e, successful.
                        // console.log(d);
                        //show the success status message.
                        notify('Message', d.message, '', 'ci-security-check', 'success');
                        if (d.data.status) {
                            document.querySelector('#star-' + d.data.selector).innerHTML =
                                ' <i class="ci-star-filled text-warning"></i>';
                        } else {
                            document.querySelector('#star-' + d.data.selector).innerHTML =
                                ' <i class="ci-star"></i>';
                            document.querySelector('#container-' + d.data.selector).remove();
                        }

                    } else if (d.success == 0) { //if the request returs with success = 0,i.e, its failed.
                        //show the error status message get from the backend. 
                        notify('Error Message', d.message, '', 'ci-security-prohibition', 'danger');
                    }
                }).catch((err) => {
                    // console.log(err);
                    notify('Error Message', err.message, '', 'ci-security-prohibition', 'danger');
                });
        }
    </script>

@endsection

@section('contents')
    <div class="d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
        <div class="w-100 text-light text-center me-3">
            <div class="row d-none d-lg-flex">
                <div class="col-sm-3 ">
                    <div class="card text-primary shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ count($data['files']) }}</h5>
                            <p class="card-text fs-sm ">Files</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card text-primary shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ formatBytes($data['totalSize']) }}</h5>
                            <p class="card-text fs-sm ">Total Storage Used</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card text-primary shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary">110 MB</h5>
                            <p class="card-text fs-sm ">Total Storage</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card text-primary shadow-lg">
                        <div class="card-body">
                            <h5 class="card-title text-primary">110 MB</h5>
                            <p class="card-text fs-sm ">Total Storage</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">

                @if (count($data['files']) > 0)
                    @foreach ($data['files'] as $file)
                        <div class="col-lg-2 col-md-3 col-sm-6  mb-3"
                            id="{{ 'container-' . explode('.', $file->slugName)[0] }}">
                            <div class="card product-card-alt border shadow-lg">
                                <div class="product-thumb">
                                    <button class="btn-wishlist btn-sm"
                                        id="{{ 'star-' . explode('.', $file->slugName)[0] }}"
                                        onclick="toggleFileStarred('{{ $file->slugName }}')" type="button">
                                        @if ($file->starred == 0)
                                            <i class="ci-star"></i>
                                        @else
                                            <i class="ci-star-filled text-warning"></i>
                                        @endif
                                    </button>
                                    <div class="product-card-actions">
                                        <a class="btn btn-light btn-icon btn-shadow fs-base mx-2" href="#"
                                            data-bs-toggle="modal" data-bs-target="#fileDetailsModal"
                                            onclick="updateFilePreviewModal({{ $file }})">
                                            <i class="ci-eye"></i>
                                        </a>
                                        <button class="btn btn-light btn-icon btn-shadow fs-base mx-2" type="button"
                                            data-clipboard-text="{{ env('APP_URL') . '/storage/files/original/' . $file->slugName }}">
                                            <i class="far fa-clipboard"></i>
                                        </button>
                                    </div>
                                    <a class="product-thumb-overlay"></a>
                                    @if ($file->type == 'image')
                                        <img src="/storage/files/thumb/{{ $file->slugName }}" alt="{{ $file->name }}">
                                    @else
                                        <img class="p-2"
                                            src="/storage/extensionImages/{{ explode('.', $file->slugName)[1] }}.png"
                                            alt="{{ $file->name }}">
                                    @endif
                                </div>
                                <div class="pt-3 text-start px-3">
                                    <p class="text-body filename" title="{{ $file->name }}">
                                        @if ($file->type == 'image')
                                            <i class="ci-image"></i>
                                        @elseif($file->type == 'video')
                                            <i class="ci-video"></i>
                                        @else
                                            <i class="ci-document"></i>
                                        @endif
                                        &nbsp; {{ $file->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="floating-button">
        <button class="btn btn-primary rounded-pill btn-icon shadow-lg btn-xl" type="button" data-bs-toggle="modal"
            data-bs-target="#file-upload">
            <i class="ci-add"></i>
        </button>
    </div>
@endsection
