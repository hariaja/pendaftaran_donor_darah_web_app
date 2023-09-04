let table;

$(() => {
    table = $(".table").DataTable();
});

function deleteEvent(url) {
    Swal.fire({
        icon: "warning",
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
        showCancelButton: true,
        confirmButtonText: "Hapus Data",
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#E74C3C",
        confirmButtonColor: "#3498DB",
    }).then((result) => {
        if (result.value) {
            $.post(url, {
                _token: $("[name=csrf-token]").attr("content"),
                _method: "delete",
            })
                .done((response) => {
                    Swal.fire({
                        icon: "success",
                        title: response.message,
                        confirmButtonText: "Selesai",
                    });
                    table.ajax.reload();
                })
                .fail((errors) => {
                    Swal.fire({
                        icon: "error",
                        title: errors.responseJSON.message,
                        confirmButtonText: "Mengerti",
                    });
                    return;
                });
        } else if (result.dismiss == swal.DismissReason.cancel) {
            Swal.fire({
                icon: "error",
                title: "Tidak ada perubahan disimpan",
                confirmButtonText: "Mengerti",
                confirmButtonColor: "#3498DB",
            });
        }
    });
}

$(document).on("click", ".delete-events", function (e) {
    e.preventDefault();
    let url = urlDestroy;
    url = url.replace(":uuid", $(this).data("uuid"));
    deleteEvent(url);
});

function showEvent(url) {
    const modal = $("#modal-show-event");
    const modalContent = modal.find(".modal-content");

    modal.modal("show");
    modal.find(".block-title").text("Detail Data Event");

    $.get(url).done((response) => {
        //
    });
}

$(document).on("click", ".show-events", function (e) {
    e.preventDefault();
    let url = urlShow;
    url = url.replace(":uuid", $(this).data("uuid"));
    showEvent(url);
});
