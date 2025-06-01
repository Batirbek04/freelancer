<?php include('includes/header.php'); ?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Market | Bas bet </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }

        .hero {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 0;
            width: 100%;
            height: 100px;
            background: white;
            border-top-left-radius: 100% 20px;
            border-top-right-radius: 100% 20px;
            z-index: 1;
        }

        .hero h1, .hero p {
            position: relative;
            z-index: 2;
        }

        .section {
            padding: 80px 0;
        }

        .service-box {
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 30px;
            background: #ffffff;
            transition: 0.4s ease;
            cursor: pointer;
        }

        .service-box:hover {
            transform: scale(1.05);
            background: #f8f9ff;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .btn-lg {
            transition: 0.3s ease;
        }

        .btn-lg:hover {
            transform: scale(1.05);
        }

        footer {
            background: #333;
            color: #fff;
            padding: 30px 0;
        }

        footer a {
            color: #ccc;
            text-decoration: none;
            transition: 0.2s;
        }

        footer a:hover {
            color: #fff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1 class="display-4" data-aos="fade-down">Freelancer Market</h1>
        <p class="lead" data-aos="fade-up" data-aos-delay="200">Freelancerler hám jumıs beriwshiler ushın tolıq platforma</p>
        <a href="pages/register.php" class="btn btn-light btn-lg mt-3" data-aos="zoom-in" data-aos-delay="400">Tizimnen ótiw</a>
        <a href="pages/login.php" class="btn btn-outline-light btn-lg mt-3" data-aos="zoom-in" data-aos-delay="500">Tizimge kiriw</a>
    </div>
</section>

<!-- Services -->
<section class="section bg-light">
    <div class="container text-center">
        <h2 class="mb-5" data-aos="fade-up">Nege bizdi tańlaydı?</h2>
        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="service-box">
                    <h4>Tez hám ańsat jumıs tabıw</h4>
                    <p>Jumıs izlewshiler ushın ápiwayılastırılǵan interfeys arqalı jumıs tabıw júdá ańsat.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="service-box">
                    <h4>Qáwipsiz tólem sisteması</h4>
                    <p>Frilanserler óz miyneti ushın qáwipsiz hám isenimli haqı aladı.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="service-box">
                    <h4>Jumıs beriwshiler ushın qolaylıq</h4>
                    <p>Proekttiń járiyalaw hám frilanserlerdi basqarıw júdá ápiwayı.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section text-center">
    <div class="container" data-aos="fade-up">
        <h2>Búgin-aq dizimnen ótiń hám háreketti baslań!</h2>
        <a href="pages/register.php" class="btn btn-primary btn-lg mt-3">BASLAŃ</a>
    </div>
</section>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p>&copy; <?= date("Y") ?> Freelancer Market. Barlıq huqıqlar qorǵalǵan.</p>
        <p>
    <a href="https://t.me/qmukompyuter" target="_blank">Telegram</a> | 
    <a href="https://www.instagram.com/raxmanberdiev_b/" target="_blank">Instagram</a>
</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

</body>
</html>
