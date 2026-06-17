<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Klinik Sederhana</title>
    <!-- Google Fonts: Inter for a clean, medical-friendly modern look -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-body: #f8fafc;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-body);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            overflow: hidden;
            background: #ffffff;
        }
        .login-header {
            padding: 2.5rem 2rem 1.5rem;
            text-align: center;
        }
        .login-header i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .login-header h3 {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
        }
        .login-body {
            padding: 0 2.5rem 2.5rem;
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            border-color: #cbd5e1;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgb(56 189 248 / 0.1);
        }
        .form-label {
            font-weight: 500;
            color: #475569;
            font-size: 0.9rem;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
            letter-spacing: 0.02em;
            transition: all 0.2s;
        }
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgb(37 99 235 / 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card">
                    <div class="login-header">
                        <i class="bi bi-hospital"></i>
                        <h3>KlinikKu</h3>
                        <p class="text-muted small mb-0">Sistem Informasi Manajemen Klinik</p>
                    </div>
                    <div class="login-body">
                        <?php if(session()->getFlashdata('error')):?>
                            <div class="alert alert-danger rounded-3 py-2 px-3 small d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif;?>

                        <form action="<?= base_url() ?>login" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control border-start-0 ps-0" id="email" placeholder="admin@klinik.local" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 text-muted">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control border-start-0 ps-0" id="password" placeholder="••••••••" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-2">Masuk ke Sistem</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
