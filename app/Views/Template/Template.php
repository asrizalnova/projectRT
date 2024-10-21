<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>AdminKasRT16</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= base_url('Assets/assets/img/kaiadmin/favicon.ico') ?>" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="<?= base_url('Assets/assets/js/plugin/webfont/webfont.min.js') ?>"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["<?= base_url('assets/css/fonts.min.css'); ?>"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('Assets/assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('Assets/assets/css/plugins.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('Assets/assets/css/kaiadmin.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('Assets/assets/css/demo.css') ?>" />
</head>

<body class="app">
    <?= $this->include('admin/layout/header'); ?>

    <div class="app-wrapper">
        <?= $this->renderSection('content'); ?>
    </div>

    <!--   Core JS Files   -->
    <script src="<?= base_url('Assets/assets/js/core/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/core/popper.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/chart.js/chart.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/chart-circle/circles.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/jsvectormap/jsvectormap.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/jsvectormap/world.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/plugin/sweetalert/sweetalert.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/kaiadmin.min.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/setting-demo.js') ?>"></script>
    <script src="<?= base_url('Assets/assets/js/demo.js') ?>"></script>

    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#2e7d32",
            fillColor: "rgba(46, 125, 50, 0.14)",
        });

        // Initialize Charts
        Circles.create({
            id: "circle1",
            radius: 30,
            value: 60,
            maxValue: 100,
            width: 4,
            text: "60%",
            colors: ["#177dff", "#f0f0f0"],
            duration: 400,
            wrpClass: "circles-wrp",
            textClass: "circles-text",
        });

        Circles.create({
            id: "circle2",
            radius: 30,
            value: 40,
            maxValue: 100,
            width: 4,
            text: "40%",
            colors: ["#f3545d", "#f0f0f0"],
            duration: 400,
            wrpClass: "circles-wrp",
            textClass: "circles-text",
        });

        Circles.create({
            id: "circle3",
            radius: 30,
            value: 80,
            maxValue: 100,
            width: 4,
            text: "80%",
            colors: ["#2e7d32", "#f0f0f0"],
            duration: 400,
            wrpClass: "circles-wrp",
            textClass: "circles-text",
        });
    </script>
</body>
