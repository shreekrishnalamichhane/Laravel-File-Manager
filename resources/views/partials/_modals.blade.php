<form action="{{ route('logout') }}" method="POST" id="logout-form">
    @csrf
</form>

{{-- file uplaod modal --}}
<div class="modal fade" id="file-upload" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New File</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Drag and drop file upload -->
                    <div class="file-drop-area">
                        <div class="file-drop-icon ci-cloud-upload"></div>
                        <span class="file-drop-message">Drag and drop here to upload</span>
                        <input type="file" class="file-drop-input" name="file">
                        <button type="button" class="file-drop-btn btn btn-primary btn-sm">Or select file</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary btn-shadow btn-sm" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- File details modal --}}
<div class="modal fade" id="fileDetailsModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modalXL" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn-close" id="fileModalCloseBtn" type="button" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <img id="fileModalImage" src="" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <h5 class="modal-title" id="fileModalTitle"></h5>
                        <hr>
                        <dl class="row pt-3">
                            <dt class="col-6">File Size :</dt>
                            <dd class="col-6" id="fileSizeFormatted"></dd>
                            <dt class="col-6">Extension :</dt>
                            <dd class="col-6" id="fileExtension"></dd>
                            <dt class="col-6">Type :</dt>
                            <dd class="col-6" id="fileType"></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="fileDeleteBtn" class="text-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
