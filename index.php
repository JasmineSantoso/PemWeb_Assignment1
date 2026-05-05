<?php
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = mysqli_connect("localhost", "root", "", "lat_pemweb");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data + sanitasi sederhana
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $number = trim($_POST['telpon']);
    $birth_date = $_POST['birthdate'];
    $gender = $_POST['gender'] ?? '';
    $town = $_POST['town'];
    $message = trim($_POST['message']);

    // Validasi sederhana
    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'message' => 'Data wajib belum lengkap.'
        ];
        header("Location: index.php");
        exit();
    }

    // Upload file
    $file_name = NULL;
    $upload_dir = "uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $max_size = 2 * 1024 * 1024; // 2MB

        if ($_FILES['file']['size'] > $max_size) {
            $_SESSION['flash'] = [
                'type' => 'error',
                'message' => 'Ukuran file terlalu besar (max 2MB).'
            ];
            header("Location: index.php");
            exit();
        }

        $file_name = time() . "_" . basename($_FILES['file']['name']);
        $tmp_name = $_FILES['file']['tmp_name'];

        move_uploaded_file($tmp_name, $upload_dir . $file_name);
    }

    // Prepared statement
    $stmt = $conn->prepare("INSERT INTO Messenger 
    (name, email, phone_number, birth_date, gender, town, file, message)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssss", 
        $name, 
        $email, 
        $number, 
        $birth_date, 
        $gender, 
        $town, 
        $file_name, 
        $message
    );

    $stmt->execute();

    // Success message
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => "Thank you for your feedback {$name} 💖"
    ];

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum Vitae - Jasmine</title>
    
    <link rel="stylesheet" href="style.css">
    <script src="index.js" defer></script>
</head>
<body>

    <header>
        <div class="header-content">
            <h1>INTRODUCTION</h1>
            <h2>Jasmine Aulia Santoso</h2>
        </div>
    </header>

    <nav>
        <div class="nav-container">
            <a href="index.html" class="nav-link active">Homepage</a>
            <a href="page.html" class="nav-link">Portofolio</a>
        </div>
    </nav>

    <main class="content-container">

        <section class="about-me-text">
            <h3><strong>ABOUT ME</strong></h3>
            <p>I am an Informatics Engineering student at the University of Mataram with a strong interest in software development and computer systems. I enjoy learning new technologies and applying programming skills to solve real-world problems. Through my academic projects, I have developed experience in programming, system design, and problem-solving. I am a motivated learner who is eager to improve technical skills and contribute to innovative technology projects.</p>
        </section>

        <section class="profile-section">
            <div class="profile-text">
                <p><strong>Name:</strong> Jasmine Aulia Santoso</p>
                <a><strong>Age:</strong> 19 years old</a>
                <p><strong>Major:</strong> Informatics Engineering</p>
                <p><strong>Status:</strong> Undergraduate</p>
            </div>

            <div class="img">
                <img src="Photo.jpg" alt="Graduate Picture" width="100">
            </div>
        </section>
        
        
        <section>
            <table class="education-table">
                 <caption class="caption">Education</caption>
                <thead>
                    <tr>
                        <th>Institution</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>University of Mataram</td>
                        <td>2024-Present</td>
                    </tr>
                    <tr>
                        <td>MAN 2 Mataram</td>
                        <td>2021-2024</td>
                    </tr>
                    <tr>
                        <td>MTsN 1 Mataram</td>
                        <td>2018-2021</td>
                    </tr>
                    <tr>
                        <td>SDN 13 Mataram</td>
                        <td>2012-2018</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section>
            <table class="organization-table">
                 <caption class="caption">Experience</caption>
                <thead>
                    <tr>
                        <th>Organization</th>
                        <th>Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Himpunan Mahasiswa Informatika (HMIF)</td>
                        <td>2025-Present</td>
                    </tr>
                    <tr>
                        <td>ORSIMA MAN 2 Mataram</td>
                        <td>2022-2023</td>
                    </tr>
                    <tr>
                        <td>Teater MATA MAN 2 Mataram</td>
                        <td>2022-2023</td>
                    </tr>
                    <tr>
                        <td>PASKIBRAKA Provinsi Nusa Tenggara Barat</td>
                        <td>2022</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <br>

        <section class="contact-section">
            <form action="index.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend style="color:hotpink">Leave some messages here!</legend>
                
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required placeholder="Name">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="telpon">Number:</label>
                        <input type="tel" id="telpon" name="telpon" required placeholder="Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="birthdate">Birth Date:</label>
                        <input type="date" id="birthdate" name="birthdate" required placeholder="Birth Date">
                    </div>
                        
                    <div class="form-group">
                        <label>Gender:</label>
                        <div class="radio-group">
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>

                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="town">Town:</label>
                        <select id="town" name="town">
                            <option value="-">-- Choose Your Town --</option>
                            <option value="mataram">Mataram</option>
                            <option value="lobar">Lombok Barat</option>
                            <option value="loteng">Lombok Tengah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="File">Upload File:</label>
                        <input type="file" id="file" name="file" accept="*/*">
                        <small id="nameError" class="error-message"></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="4" required></textarea>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" class="btn-primary">Send</button>
                    </div>
                </fieldset>
                <br>
                
                <?php if (isset($_SESSION['flash'])): ?>
                    <div style="
                        color: <?= $_SESSION['flash']['type'] == 'success' ? 'green' : 'red' ?>;
                        font-weight: bold;
                    ">
                        <?= htmlspecialchars($_SESSION['flash']['message']); ?>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

            </form>
        </section>

        <section class="social-section">
            <p>Social Media</p>
            <div class="social-grid">
                <div class="social-item">
                    <span class="social-icon">💌</span>
                    <a href="https://www.instagram.com/_jasmineaulia/" class="social-link">Instagram</a>
                </div>

                <div class="social-item">
                    <span class="social-icon">🎀</span>
                    <a href="https://www.tiktok.com/@chemtrailclubs?is_from_webapp=1&sender_device=pc" class="social-link">TikTok</a>
                </div>
            </div>
        </section>    
    </main>

    <footer>
        <hr>
        <p>&copy; 2026 Jasmine - Thanks for your visit!</p>
    </footer>
    
</body>
</html>