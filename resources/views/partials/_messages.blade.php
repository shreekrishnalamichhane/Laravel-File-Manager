<script>
    function notify(title, message, url, icon, type) {
        $.notify({
            icon: icon,
            title: title,
            message: message,
            url: url
        }, {
            element: 'body',
            type: type,
            allow_dismiss: true,
            placement: {
                from: 'bottom',
                align: 'left'
            },
            offset: {
                x: 15, // Keep this as default
                y: 15 // Unless there'll be alignment issues as this value is targeted in CSS
            },
            spacing: 10,
            z_index: 1080,
            delay: 2500,
            timer: 3000,
            url_target: '_blank',
            mouse_over: false,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            template: '<div data-notify="container" class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">' +
                '<div class="toast-header bg-{0} text-white">' +
                '<i data-notify="icon" class="ci-bell me-2"></i>' +
                '<span class="fw-medium me-auto" data-notify="title">{1}</span>' +
                '<button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast"' +
                'aria-label="Close" data-notify="dismiss"></button>' +
                '</div>' +
                '<div class="toast-body text-{0}" data-notify="message">{2}</div>' +
                '</div>'
        });

    }
</script>

{{-- '<div data-notify="container" class="alert alert-dismissible alert-{0} alert-notify" role="alert">' +
    '<span class="alert-icon" data-notify="icon"></span> ' +
    '<div class="alert-text"</div> ' +
    '<span class="alert-title" data-notify="title">{1}</span> ' +
    '<span data-notify="message">{2}</span>' +
    '</div>' +
    '<div class="progress" data-notify="progressbar">' +
    '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
    '</div>' +
    '<a href="{3}" target="{4}" data-notify="url"></a>' +
    '<button type="button" class="btn-close" data-notify="dismiss" aria-label="Close"></button>' +
    '</div>' --}}
@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <script>
            notify('Error Message', `{{ $error }}`, '', 'ci-security-close', 'danger');
        </script>
    @endforeach
@endif
@if (session('success'))
    <script>
        notify('Message', `{{ session('success') }}`, '', 'ci-security-check', 'success');
    </script>
@endif
@if (session('warning'))
    <script>
        notify('Warnings', `{{ session('warning') }}`, '', 'ci-security-announcement', 'warning');
    </script>
@endif
@if (session('danger'))
    <script>
        notify('Error', `{{ session('danger') }}`, '', 'ci-security-prohibition', 'danger');
    </script>

@endif
@if (session('info'))
    <script>
        notify('Notification', `{{ session('info') }}`, '', 'ci-idea', 'info');
    </script>

@endif
