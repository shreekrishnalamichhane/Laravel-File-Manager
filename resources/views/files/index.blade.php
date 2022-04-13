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
            fetch("{{ route('files.toggleFileStarred') }}", { //url is provided as the parameter in the function.
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
                    if (d.success == 1) {
                        notify('Message', d.message, '', 'ci-security-check', 'success');
                        if (d.data.status) {
                            document.querySelector('#star-' + d.data.selector).innerHTML =
                                ' <i class="ci-star-filled text-warning"></i>';
                        } else {
                            document.querySelector('#star-' + d.data.selector).innerHTML =
                                ' <i class="ci-star"></i>';


                        }

                    } else if (d.success == 0) {
                        notify('Error Message', d.message, '', 'ci-security-prohibition', 'danger');
                    }
                }).catch((err) => {
                    notify('Error Message', err.message, '', 'ci-security-prohibition', 'danger');
                });
        }
    </script>
@endsection

@section('contents')
    {{-- <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
            <div class="d-flex w-100 text-light text-center me-3">
                <div class="fs-ms px-3">
                    <div class="fw-medium">Date Submitted</div>
                    <div class="opacity-60">09/27/2019</div>
                </div>
                <div class="fs-ms px-3">
                    <div class="fw-medium">Last Updated</div>
                    <div class="opacity-60">09/30/2019</div>
                </div>
                <div class="fs-ms px-3">
                    <div class="fw-medium">Type</div>
                    <div class="opacity-60">Website problem</div>
                </div>
                <div class="fs-ms px-3">
                    <div class="fw-medium">Priority</div><span class="badge bg-warning">High</span>
                </div>
                <div class="fs-ms px-3">
                    <div class="fw-medium">Status</div><span class="badge bg-success">Open</span>
                </div>
            </div>
            <a class="btn btn-primary btn-sm btn-sm" href="#"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                    class="ci-sign-out me-2"></i>Sign
                out</a>
        </div> --}}
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
