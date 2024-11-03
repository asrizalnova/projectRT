<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3</title>

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
        // $(function() {
        //     $("#example1").DataTable({
        //         "responsive": true,
        //         "lengthChange": false,
        //         "autoWidth": false,
        //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        // });

        // Fungsi untuk menangani pengeditan data KK
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                autoWidth: false,
                lengthChange: false,
                paging: true,
                searching: true
            });

            // Klik tombol Edit untuk KK
            $('.btnEditKK').on('click', function() {
                const noKK = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk KK
                $.ajax({
                    url: "<?= site_url('kk/edit'); ?>/" + noKK,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#editNoKK').val(data.noKK);
                        $('#editNamaKK').val(data.namaKK);
                        $('#editStatus').val(data.status);

                        // Set action form untuk mengarah ke metode update
                        $('#editKKForm').attr('action', "<?= site_url('kk/update'); ?>/" + noKK);

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


            // Fungsi untuk menambahkan data KK
            $('#createKK').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('kk/store'); ?>",
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

            // Fungsi untuk menghapus data KK
            // $('.btnDeleteKK').on('click', function(e) {
            //     e.preventDefault();

            //     const noKK = $(this).data('id'); // Ambil noKK dari tombol

            //     // Konfirmasi penghapusan dengan Swal
            //     Swal.fire({
            //         title: 'Apakah Anda yakin?',
            //         text: "Data ini akan dihapus secara permanen!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, hapus!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // Kirim permintaan penghapusan dengan AJAX
            //             $.ajax({
            //                 url: "<?= base_url('kk/delete/'); ?>" + noKK,
            //                 type: "DELETE",
            //                 dataType: "json",
            //                 success: function(response) {
            //                     if (response.status) {
            //                         // Hapus baris tabel setelah berhasil dihapus
            //                         $('#row-' + noKK).remove();

            //                         // Tampilkan notifikasi sukses
            //                         Swal.fire({
            //                             title: 'Terhapus!',
            //                             text: 'Data KK berhasil dihapus.',
            //                             icon: 'success',
            //                             timer: 3000,
            //                             showConfirmButton: false
            //                         });
            //                     } else {
            //                         Swal.fire('Gagal', 'Gagal menghapus data KK.', 'error');
            //                     }
            //                 },
            //                 error: function() {
            //                     Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data KK.', 'error');
            //                 }
            //             });
            //         }
            //     });
            // });

            // Fungsi untuk menangani pengeditan data Kas
            $('.btnEditKas').on('click', function() {
                const idKas = $(this).data('id');

                // Ambil data dari server menggunakan AJAX untuk Kas
                $.ajax({
                    url: "<?= site_url('kas/edit'); ?>/" + idKas,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        $('#editNamaKas').val(data.namaKas);
                        $('#editJenis').val(data.jenis);
                        $('#editSaldo').val(data.saldo);

                        // Set action form untuk mengarah ke metode update
                        $('#editKasForm').attr('action', "<?= site_url('kas/update'); ?>/" + idKas);

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

            // Fungsi untuk menambahkan data Kas
            $('#createKas').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "<?= site_url('kas/store'); ?>",
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
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan penghapusan dengan AJAX
                        $.ajax({
                            url: "<?= site_url('kas/delete'); ?>/" + idKas,
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