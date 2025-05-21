<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Certificates - AIT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styling -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand img {
            height: 60px;
        }

        .nav-link {
            font-weight: 500;
            color: #333;
        }

        .nav-link.active,
        .nav-link:hover {
            color: #00796B;
            border-bottom: 2px solid #00796B;
        }

        .search-box {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .certificate-img {
            max-height: 180px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card-header {
            font-size: 1rem;
        }

        footer {
            background-color: #ffffff;
            padding: 60px 0 20px;
            margin-top: 80px;
            border-top: 1px solid #e4e4e4;
        }

        .footer-title {
            font-weight: 600;
            color: #00796B;
            margin-bottom: 15px;
        }

        .footer-logo {
            height: 70px;
        }

        .footer-link a {
            color: #333;
            text-decoration: none;
        }

        .footer-link a:hover {
            color: #00796B;
        }

        .btn-primary {
            background-color: #00796B;
            border-color: #00796B;
        }

        .btn-primary:hover {
            background-color: #00695c;
            border-color: #00695c;
        }

        .btn-outline-primary,
        .btn-outline-info {
            border-radius: 50px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('ait logo.png') }}" alt="AIT Logo">
        </a>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Result</a></li>
            </ul>
            <a href="#" class="btn btn-primary ms-3">Login</a>
        </div>
    </div>
</nav>

<!-- Search Section -->
<div class="container">
    <div class="search-box">
        <h4 class="text-center mb-4">🔎 Search Certificate by Registration Number</h4>
        <form action="{{ route('searchCertificate') }}" method="GET">
            <div class="input-group">
                <input type="text" name="regNo" class="form-control" placeholder="Enter Reg No" value="{{ old('regNo', $regNo ?? '') }}" required>
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
        @if(session('error'))
            <div class="alert alert-danger mt-3 text-center">{{ session('error') }}</div>
        @endif
    </div>

    @if(isset($student))
    <div class="card border-info shadow-sm mb-5">
        <div class="card-header bg-info text-white">
            <strong>Student:</strong> {{ $student->name }} (Reg No: {{ $student->regNo }})
        </div>
        <div class="card-body">
            @if($certificates->count() > 0)
                <div class="row g-4">
                    @foreach($certificates as $certificate)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center">
                                    @php
                                        $ext = pathinfo($certificate->certificate_path, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(strtolower($ext) === 'pdf')
                                        <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank" class="btn btn-outline-info w-100 mb-2">📄 View PDF</a>
                                    @else
                                        <a href="{{ asset('storage/' . $certificate->certificate_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $certificate->certificate_path) }}" class="img-fluid certificate-img" alt="Certificate">
                                        </a>
                                    @endif

                                    <a href="{{ asset('storage/' . $certificate->certificate_path) }}" download class="btn btn-outline-primary w-100 mt-2">⬇️ Download</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-muted mt-3">No certificates found for this student.</p>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-3 mb-4">
                <img src="{{asset('ait logo.png')}}" alt="Logo" class="footer-logo">
                <p>AIT Computer (Aradhya Institute of Technology) offers professional courses like DCA, ADCA, DTP, Tally, PGDCA, O Level, and more.</p>
            </div>
            <div class="col-md-3 mb-4 footer-link">
                <div class="footer-title">Quick Links</div>
                <p><a href="#">Home</a></p>
                <p><a href="#">About Us</a></p>
                <p><a href="#">Courses</a></p>
                <p><a href="#">Gallery</a></p>
                <p><a href="#">Contact Us</a></p>
            </div>
            <div class="col-md-3 mb-4 footer-link">
                <div class="footer-title">Explore</div>
                <p><a href="#">Start Here</a></p>
                <p><a href="#">Success Story</a></p>
                <p><a href="#">Courses</a></p>
                <p><a href="#">About Us</a></p>
                <p><a href="#">Contact Us</a></p>
            </div>
            <div class="col-md-3 mb-4">
                <div class="footer-title">Contact Us</div>
                <p>📍 Chhoti Gate Susuwahi, Navneeta Kunwar School, Varanasi</p>
                <p>📧 ait23588@gmail.com</p>
                <p>📞 +91 9555610401, +91 9451118782</p>
            </div>
        </div>
        <div class="text-center pt-3 border-top mt-3">
            <small>© 2025 AIT Computer | Developed by <strong>Shubham Infotech</strong></small>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
