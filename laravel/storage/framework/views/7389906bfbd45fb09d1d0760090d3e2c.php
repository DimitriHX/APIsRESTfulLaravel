<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'La Buena Mesa - Alta Gastronomía & Menú Digital'); ?></title>

    <!-- Google Fonts: Bebas Neue, Oswald, Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Materialize CSS CDN & Material Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        :root {
            --wine-dark: #2b1118;
            --wine-medium: #541d2a;
            --wine-soft: #732b3b;
            --wine-muted: #471a24;
            --accent-gold: #d4af37;
            --accent-gold-light: #f5e6be;
            --bg-neutral: #f8f6f3;
            --text-main: #2d2627;
            --text-muted: #5e5254;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--bg-neutral);
            color: var(--text-main);
            font-family: 'Montserrat', sans-serif;
            font-size: 0.98rem;
            line-height: 1.5;
            padding-bottom: 60px; /* Offset para evitar solapamiento con el footer fijo */
            box-sizing: border-box;
        }

        .font-bebas {
            font-family: 'Bebas Neue', sans-serif !important;
            letter-spacing: 1.5px;
        }

        .font-oswald {
            font-family: 'Oswald', sans-serif !important;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .font-montserrat {
            font-family: 'Montserrat', sans-serif !important;
        }

        h1, h2, .main-title {
            font-family: 'Bebas Neue', sans-serif !important;
            letter-spacing: 2px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        h3, h4, h5, h6 {
            font-family: 'Oswald', sans-serif !important;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Navigation Header */
        nav {
            background-color: var(--wine-dark) !important;
            box-shadow: 0 4px 18px rgba(43, 17, 24, 0.25);
            border-bottom: 2px solid var(--accent-gold);
            height: 65px;
            line-height: 65px;
        }

        .nav-wrapper .brand-logo {
            font-family: 'Bebas Neue', sans-serif !important;
            color: var(--accent-gold) !important;
            font-size: 2.1rem;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-wrapper .brand-logo i {
            color: var(--accent-gold);
            font-size: 1.9rem;
            margin-right: 6px;
        }

        nav ul a {
            font-family: 'Oswald', sans-serif;
            font-size: 1rem;
            letter-spacing: 1px;
            color: #f2e9ea !important;
            transition: all 0.3s ease;
        }

        nav ul a:hover {
            color: var(--accent-gold) !important;
            background-color: rgba(212, 175, 55, 0.12);
        }

        /* Tarjetas */
        .card-wine {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid rgba(84, 29, 42, 0.12);
            box-shadow: 0 8px 24px rgba(43, 17, 24, 0.06);
            background-color: #ffffff;
        }

        .card-header-wine {
            background: linear-gradient(135deg, var(--wine-dark) 0%, var(--wine-medium) 100%);
            color: #ffffff;
            padding: 16px 24px;
            border-bottom: 2px solid var(--accent-gold);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header-wine h4, .card-header-wine h5 {
            margin: 0;
            color: var(--accent-gold-light);
            font-family: 'Oswald', sans-serif !important;
        }

        /* Botones */
        .btn-wine {
            background-color: var(--wine-medium) !important;
            color: #ffffff !important;
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 4px;
            border: 1px solid var(--accent-gold);
            box-shadow: 0 3px 10px rgba(84, 29, 42, 0.25);
            transition: all 0.3s ease;
        }

        .btn-wine:hover {
            background-color: var(--wine-dark) !important;
            color: var(--accent-gold) !important;
            box-shadow: 0 5px 14px rgba(43, 17, 24, 0.4);
            transform: translateY(-1px);
        }

        .btn-gold-outline {
            background-color: transparent !important;
            color: var(--wine-medium) !important;
            border: 1.5px solid var(--wine-medium) !important;
            font-family: 'Oswald', sans-serif;
            font-weight: 600;
            letter-spacing: 0.8px;
            border-radius: 4px;
        }

        .btn-gold-outline:hover {
            background-color: var(--wine-medium) !important;
            color: white !important;
        }

        /* Badges de Estado */
        .badge-disponible {
            background-color: #2e7d32;
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 14px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-no-disponible {
            background-color: #c62828;
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 14px;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .luxury-divider {
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--accent-gold), transparent);
            margin: 15px 0;
        }

        .price-tag {
            font-family: 'Oswald', sans-serif;
            font-weight: 700;
            color: var(--wine-medium);
            font-size: 1.15rem;
        }

        /* Footer Fijo Limpio y Compacto (Evita bug de scroll infinito) */
        footer.fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50px;
            background-color: var(--wine-dark);
            border-top: 2px solid var(--accent-gold);
            color: #ffffff;
            z-index: 999;
            box-shadow: 0 -4px 15px rgba(0,0,0,0.3);
            display: flex;
            align-items: center;
        }

        footer.fixed-footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 92%;
            max-width: 1440px;
        }

        footer.fixed-footer .footer-brand {
            font-family: 'Oswald', sans-serif;
            color: var(--accent-gold-light);
            font-size: 1.1rem;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        footer.fixed-footer .endpoint-links {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        footer.fixed-footer .endpoint-links a {
            color: #e3d9db;
            font-family: 'Montserrat', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        footer.fixed-footer .endpoint-links a:hover {
            color: var(--accent-gold);
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Header de Navegación -->
    <nav>
        <div class="nav-wrapper container" style="width: 92%; max-width: 1440px;">
            <a href="<?php echo e(url('/')); ?>" class="brand-logo">
                <i class="material-icons">restaurant</i> La Buena Mesa
            </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo e(url('/menu')); ?>"><i class="material-icons left">menu_book</i> Menú Digital</a></li>
                <li><a href="<?php echo e(url('/api/menu-items')); ?>" target="_blank"><i class="material-icons left">code</i> API REST (JSON)</a></li>
            </ul>
        </div>
    </nav>

    <!-- Contenedor Principal -->
    <main class="container" style="margin-top: 20px; width: 92%; max-width: 1440px;">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer Fijo de Barra Delgada (Fixed Footbar) -->
    <footer class="fixed-footer">
        <div class="container">
            <div class="footer-brand">
                <i class="material-icons tiny" style="color: var(--accent-gold);">restaurant</i>
                <span>Restaurante "La Buena Mesa"</span>
            </div>
            <div class="endpoint-links">
                <a href="<?php echo e(url('/api/menu-items')); ?>" target="_blank">GET /api/menu-items</a>
                <span style="color: var(--accent-gold);">|</span>
                <a href="<?php echo e(url('/api/menu-items/category/Plato%20Fuerte')); ?>" target="_blank">GET /api/menu-items/category/{cat}</a>
            </div>
        </div>
    </footer>

    <!-- Materialize JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layout.blade.php ENDPATH**/ ?>