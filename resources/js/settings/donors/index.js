let table;

$(() => {
    table = $(".table").DataTable();
});

function deleteDonor(url) {
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

function statusUser(url) {
    Swal.fire({
        icon: "warning",
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol <b>Ubah Status</b>, Maka <b>Status Akun Pendonor</b> akan berubah!",
        showCancelButton: true,
        confirmButtonText: "Ubah Status Akun Pengguna",
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#E74C3C",
        confirmButtonColor: "#3498DB",
    }).then((result) => {
        if (result.value) {
            $.post(url, {
                _token: $("[name=csrf-token]").attr("content"),
                _method: "patch",
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

$(document).on("click", ".delete-donations", function (e) {
    e.preventDefault();
    let url = urlDestroy;
    url = url.replace(":uuid", $(this).data("uuid"));
    deleteDonor(url);
});

$(document).on("click", ".status-users", function (e) {
    e.preventDefault();
    let url = urlStatus;
    url = url.replace(":uuid", $(this).data("uuid"));
    statusUser(url);
});

function showDonor(url) {
    const modal = $("#modal-show-donor");
    const modalContent = modal.find(".modal-content");

    modal.modal("show");
    modal.find(".block-title").text("Detail Data Pendonor");

    $.get(url).done((response) => {
        let donor = response;
        let blood = donor.blood_type;
        let user = donor.user;

        const elements = {
            "#donor-nik": donor.nik,
            "#donor-name": user.name,
            "#donor-gender": donor.gender,
            "#donor-age": donor.ageDonor,
            "#donor-dob": donor.dateBrith,
            "#donor-job": donor.job_title,
            "#donor-email": user.email,
            "#donor-phone": user.phone,
            "#blood-type": blood.type,
            "#blood-rhesus": donor.rhesus,
            "#donor-address": donor.address,
            "#donor-status-account": donor.status,
        };

        Object.entries(elements).forEach(([selector, value]) => {
            modalContent.find(selector).text(value);
        });

        const userAvatar = modalContent.find("#user-avatar");
        userAvatar.attr("src", donor.avatar);
    });
}

$(document).on("click", ".show-donations", function (e) {
    e.preventDefault();
    let url = urlShow;
    url = url.replace(":uuid", $(this).data("uuid"));
    showDonor(url);
});
