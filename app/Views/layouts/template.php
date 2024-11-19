<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= base_url('LogoRT.png'); ?>">

    <title>RT 16</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://kit.fontawesome.com/1ef5bc240d.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>//plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url() ?>//plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>//plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>//plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>//dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?= $this->include('layouts/navbar'); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?= $this->include('layouts/sidebar'); ?>

        <!-- Content Wrapper. Contains page content -->
        <?= $this->renderSection('content'); ?>
        <!-- /.content-wrapper -->

        <?= $this->include('layouts/footer'); ?>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>//plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url() ?>//plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?= base_url() ?>//plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>//plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>//plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>//plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>//plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>//dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>//dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
        // Fungsi untuk menangani pengeditan data KK
        $(document).ready(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": true,
                "paging": false,
                "language": {
                    "search": "Cari:" // Mengubah teks "Searching" menjadi "Cari"
                },
                "buttons": [{
                        extend: 'excel',
                        text: 'Ekspor ke Excel',
                        className: 'btn btn-success', // Warna hijau
                        exportOptions: {
                            columns: ':not(:last-child)' // Menyertakan semua kolom kecuali kolom terakhir
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Cetak',
                        className: 'btn btn-primary', // Warna biru
                        exportOptions: {
                            columns: ':not(:last-child)' // Menyertakan semua kolom kecuali kolom terakhir
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'Transparansi Kolom',
                        className: 'btn btn-warning' // Warna kuning
                    }
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        //CRUD Kas
        $(document).ready(function() {
            // Fungsi untuk menambahkan data Kas
            $('#createKas').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/kas/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Kas berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data Kas.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            // Fungsi untuk menangani pengeditan data Kas
            $('.btnEditKas').on('click', function() {
                const idKas = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk Kas
                $.ajax({
                    url: "<?= site_url('admin/kas/edit'); ?>/" + idKas,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#editNamaKas').val(data.namaKas);
                        $('#editJenis').val(data.jenis);
                        $('#editSaldo').val(data.saldo);

                        // Set action form untuk mengarah ke metode update
                        $('#editKasForm').attr('action', "<?= site_url('admin/kas/update'); ?>/" + idKas);

                        // Tampilkan modal edit
                        $('#editModalKas').modal('show');
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mengambil data Kas.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });

            // Kirim form edit untuk Kas
            $('#editKasForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Kas berhasil diedit!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data Kas.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });


            // Fungsi untuk menghapus data Kas
            $('.btnDeleteKas').on('click', function() {
                const idKas = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/kas/delete'); ?>/" + idKas,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + idKas).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data Kas berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data kas.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data kas.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });
        });

        //CRUD KK
        $(document).ready(function() {
            // Fungsi untuk menambahkan data KK
            $('#createKK').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/kk/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data KK berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data KK.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            $('.btnEditKK').on('click', function() {
                const noKK = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk KK
                $.ajax({
                    url: "<?= site_url('admin/kk/edit'); ?>/" + noKK,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#editNoKK').val(data.noKK);
                        $('#editNamaKK').val(data.namaKK);
                        $('#editStatus').val(data.status);

                        // Set action form untuk mengarah ke metode update
                        $('#editKKForm').attr('action', "<?= site_url('admin/kk/update'); ?>/" + noKK);

                        // Tampilkan modal edit
                        $('#editModal').modal('show');
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mengambil data untuk KK.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            // Kirim form edit untuk KK
            $('#editKKForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');

                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data KK berhasil diedit!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data KK.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            $('.btnDeleteKK').on('click', function() {
                const noKK = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/kk/delete'); ?>/" + noKK,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + noKK).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data KK berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data KK.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data KK.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });
        })

        // CRUD Iuran
        $(document).ready(function() {
            $('#createIuran').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/iuran/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Iuran berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data Iuran.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });
            // Event listener untuk tombol edit iuran
            $('.btnEditIuran').on('click', function() {
                const idIuran = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk Iuran
                $.ajax({
                    url: "<?= site_url('admin/iuran/edit'); ?>/" + idIuran,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // Mengisi dropdown dengan data
                        $('#editIdKas').empty();
                        $.each(data.kas, function(index, kas) {
                            $('#editIdKas').append(new Option(kas.namaKas, kas.idKas, kas.idKas == data.iuran.idKas, kas.idKas == data.iuran.idKas)); // Set nilai default
                        });

                        $('#editNoKK').empty(); // Hapus opsi sebelumnya
                        $.each(data.kk, function(index, kk) {
                            // Format teks yang ditampilkan di dropdown: "noKK - namaKK"
                            const displayText = `${kk.noKK} - ${kk.namaKK}`;
                            // Periksa apakah ini adalah opsi yang sesuai dengan data iuran
                            const isSelected = kk.noKK === data.iuran.noKK;
                            // Tambahkan opsi ke dropdown
                            $('#editNoKK').append(new Option(displayText, kk.noKK, isSelected, isSelected));
                        });


                        // Mengisi data yang akan diedit
                        $('#editBulan').val(data.iuran.bulan);
                        $('#editTahun').val(data.iuran.tahun);
                        $('#editJumlah').val(data.iuran.jumlah);
                        $('#editTanggal').val(data.iuran.tanggal);

                        // Set action form untuk mengarah ke metode update
                        $('#editIuranForm').attr('action', "<?= site_url('admin/iuran/update'); ?>/" + idIuran);

                        // Tampilkan modal edit
                        $('#editModalIuran').modal('show');
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mengambil data Iuran.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Kirim form edit untuk Iuran
            $('#editIuranForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModalIuran').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Iuran berhasil diedit!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data Iuran.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });

            $('.btnDeleteIuran').on('click', function() {
                const idIuran = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'

                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/iuran/delete'); ?>/" + idIuran,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + idIuran).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data iuran berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data iuran.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data iuran.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#createPengeluaran').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/pengeluaran/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Pengeluaran berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data Pengeluaran.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            // Event listener untuk tombol edit iuran
            $('.btnEditPengeluaran').on('click', function() {
                const idPengeluaran = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk Iuran
                $.ajax({
                    url: "<?= site_url('admin/pengeluaran/edit'); ?>/" + idPengeluaran,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // Mengisi dropdown dengan data
                        $('#editIdKas').empty();
                        $.each(data.kas, function(index, kas) {
                            $('#editIdKas').append(new Option(kas.namaKas, kas.idKas, kas.idKas == data.pengeluaran.idKas, kas.idKas == data.pengeluaran.idKas)); // Set nilai default
                        });

                        // Mengisi data yang akan diedit
                        // $('#editIdPengeluaran').val(data.pengeluaran.idPengeluaran);
                        $('#editNamaPengeluaran').val(data.pengeluaran.namaPengeluaran);
                        $('#editInt').val(data.pengeluaran.int);
                        $('#editTanggal').val(data.pengeluaran.tanggal);

                        // Set action form untuk mengarah ke metode update
                        $('#editPengeluaranForm').attr('action', "<?= site_url('admin/pengeluaran/update'); ?>/" + idPengeluaran);

                        // Tampilkan modal edit
                        $('#editModalPengeluaran').modal('show');
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal mengambil data Pengeluaran.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            // Kirim form edit untuk Pengeluaran
            $('#editPengeluaranForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModalPengeluaran').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Pengeluaran berhasil diedit!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data Pengeluaran.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });

            $('.btnDeletePengeluaran').on('click', function() {
                const idPengeluaran = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/pengeluaran/delete'); ?>/" + idPengeluaran,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + idPengeluaran).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data Pengeluaran berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data Pengeluaran.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data Pengeluaran.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#createUser').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/user/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data User berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data User.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            $('.btnEditUser').on('click', function() {
                const idUser = $(this).data('id');

                // Ambil data dari server menggunakan AJAX
                $.ajax({
                    url: "<?= site_url('admin/user/edit'); ?>/" + idUser,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        if (data) {
                            // Mengisi data warga
                            $('#editNama').val(data.user.nama);
                            $('#editUsername').val(data.user.username);
                            $('#editLevel').val(data.user.level);
                            $('#editStatus').val(data.user.status);

                            // Set action form untuk update
                            $('#editUserForm').attr('action', "<?= site_url('admin/user/update'); ?>/" + idUser);

                            // Tampilkan modal edit
                            $('#editModalUser').modal('show');
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data User tidak ditemukan.',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengambil data User.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModalUser').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data User berhasil diedit!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data User.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });

            $('.btnDeleteUser').on('click', function() {
                const idUser = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/user/delete'); ?>/" + idUser,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + idUser).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data User berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data User.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data User.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });

            $('.btnChangePassword').on('click', function() {
                const userId = $(this).data('id'); // Mengambil ID pengguna
                const url = "<?= site_url('admin/user/changePassword/'); ?>" + userId; // Menyusun URL untuk mengarah ke controller dengan ID

                // Tampilkan modal untuk ganti password
                $('#changePasswordModal').modal('show');

                // Set URL pada form action
                $('#changePasswordForm').attr('action', url);
            });

            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                const newPassword = $('#newPassword').val();
                const confirmPassword = $('#confirmPassword').val();

                // Validasi konfirmasi password
                if (newPassword !== confirmPassword) {
                    Swal.fire({
                        title: 'Password Tidak Cocok',
                        text: 'Password baru dan konfirmasi password tidak cocok.',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false
                    });
                    return;
                }

                // Kirim form menggunakan AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(), // Mengirim data form, termasuk password
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: 'Password berhasil diganti!',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire({
                                title: 'Gagal',
                                text: 'Gagal mengganti password.',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengganti password.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#createWarga').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('admin/warga/store'); ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Warga berhasil ditambahkan!',
                            icon: 'success',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal menambahkan data Warga.',
                            icon: 'error',
                            timer: 2000, // Tampilkan selama 3 detik
                            showConfirmButton: false // Popup otomatis menutup
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000); // Sesuaikan dengan timer di atas
                    }
                });
            });

            $('.btnEditWarga').on('click', function() {
                const nik = $(this).data('id');

                // Ambil data dari server menggunakan AJAX
                $.ajax({
                    url: "<?= site_url('admin/warga/edit'); ?>/" + nik,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        if (data) {
                            // Mengisi data warga
                            $('#editNik').val(data.warga.nik);
                            $('#editNama').val(data.warga.nama);
                            $('#editJenisKelamin').val(data.warga.jenisKelamin);
                            $('#editTempatLahir').val(data.warga.tempatLahir);
                            $('#editTanggalLahir').val(data.warga.tanggalLahir);
                            $('#editStatus').val(data.warga.status);
                            $('#editPekerjaan').val(data.warga.pekerjaan);
                            $('#editKeterangan').val(data.warga.keterangan);
                            $('#editStatusAktif').val(data.warga.statusAktif);

                            // Mengisi dropdown KK
                            $('#editNoKK').empty(); // Hapus opsi sebelumnya
                            $.each(data.kk, function(index, kk) {
                                const isSelected = kk.noKK === data.warga.noKK;
                                $('#editNoKK').append(new Option(`${kk.noKK} - ${kk.namaKK}`, kk.noKK, isSelected, isSelected));
                            });

                            // Set action form untuk update
                            $('#editWargaForm').attr('action', "<?= site_url('admin/warga/update'); ?>/" + nik);

                            // Tampilkan modal edit
                            $('#editModalWarga').modal('show');
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data warga tidak ditemukan.',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengambil data warga.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });

            $('#editWargaForm').on('submit', function(e) {
                e.preventDefault();

                const formAction = $(this).attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModalWarga').modal('hide');
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data Warga berhasil diedit!',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data Warga.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tunda reload hingga popup selesai
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });

            $('.btnDeleteWarga').on('click', function() {
                const nik = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('admin/warga/delete'); ?>/" + nik,
                            type: "DELETE",
                            dataType: "json",
                            success: function(response) {
                                if (response.status) {
                                    // Hapus baris tabel setelah berhasil dihapus
                                    $('#row-' + nik).remove();

                                    // Tampilkan notifikasi sukses
                                    Swal.fire({
                                        title: 'Terhapus!',
                                        text: 'Data Warga berhasil dihapus.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    Swal.fire({
                                        title: 'gagal',
                                        text: 'Gagal menghapus data Warga.',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });

                                    setTimeout(function() {}, 2000);
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    title: 'error!',
                                    text: 'Terjadi kesalahan saat mengapus data Warga.',
                                    icon: 'error',
                                    timer: 2000, // Tampilkan selama 3 detik
                                    showConfirmButton: false // Popup otomatis menutup
                                });

                                // Tunda reload hingga popup selesai
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }
                });
            });

        });

        $('.btnLogout').on('click', function() {
            // Menggunakan SweetAlert2 untuk konfirmasi logout
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari aplikasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user mengkonfirmasi logout, arahkan ke halaman logout
                    window.location.href = "<?= base_url('logout'); ?>";
                }
            });
        });



        function confirmAndNotify(link, noKK) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Jika pengguna mengonfirmasi, alihkan ke link yang diberikan
                const originalHref = link.getAttribute('href');

                // Buat permintaan penghapusan data
                $.ajax({
                    url: originalHref,
                    type: "GET", // Menggunakan GET untuk penghapusan
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data KK berhasil dihapus!',
                                icon: 'success',
                                timer: 2000, // Tampilkan selama 3 detik
                                showConfirmButton: false // Popup otomatis menutup
                            });

                            // Tunda reload hingga popup selesai
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            Swal.fire('Gagal!', response.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data KK.', 'error');
                    }
                });

                // Mengembalikan false agar tautan tidak melakukan pengalihan
                return false;
            }
            // Jika tidak mengonfirmasi, kembalikan true untuk membiarkan tautan melakukan pengalihan
            return true;
        }
    </script>
</body>

</html>