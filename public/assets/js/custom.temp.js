function updateFilePreviewModal(data) {
    document.querySelector('#fileModalTitle').innerHTML = data.name;
    document.querySelector('#fileSizeFormatted').innerHTML = data.sizeFormatted;
    document.querySelector('#fileExtension').innerHTML = data.extension;
    document.querySelector('#fileType').innerHTML = data.type;
    document.querySelector('#fileDeleteBtn').setAttribute('onclick', "deleteFile('" + data.slugName + "')");


    if (data.type == 'image')
        document.querySelector('#fileModalImage').src = '/storage/files/original/' + data.slugName;
    else
        document.querySelector('#fileModalImage').src = '/storage/extensionImages/' + data.slugName.split('.')[1] +
            '.png';
}

function deleteFile(slugName) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    fetch("api/files/delete", { //url is provided as the parameter in the function.
        method: 'delete',
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
                document.querySelector('#container-' + d.data.selector).remove();
                document.querySelector('#fileModalCloseBtn').click();
                notify('Message', d.message, '', 'ci-security-check', 'success');
            } else if (d.success == 0) { //if the request returs with success = 0,i.e, its failed.
                //show the error status message get from the backend. 
                notify('Error Message', d.message, '', 'ci-security-prohibition', 'danger');
            }
        }).catch((err) => {
            console.log(err);
            notify('Error Message', err.message, '', 'ci-security-prohibition', 'danger');
        });
}