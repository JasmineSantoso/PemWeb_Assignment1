<!-- <?php
// $_SESSION.start()

// $conn = mysqli_connect("localhost", "root", "", "lat_pemweb");

// // cek koneksi
// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// cek submit
// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     // ambil data dari form
//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $number = $_POST['telpon'];
//     $birth_date = $_POST['birthdate'];
//     $gender = $_POST['gender'];
//     $town = $_POST['town'];
//     $message = $_POST['message'];

//     // ambil file
//     $file_name = time() . "_" . $_FILES['file']['name']; 
//     $tmp_name = $_FILES['file']['tmp_name'];

//     // folder upload
//     $upload_dir = "uploads/";

//     // buat folder kalau belum ada
//     if (!is_dir($upload_dir)) {
//         mkdir($upload_dir, 0777, true);
//     }

//     // upload file
//     move_uploaded_file($tmp_name, $upload_dir . $file_name);

//     // query insert ke tabel Messenger
//     $query = "INSERT INTO Messenger 
//     (name, email, number, birth_date, gender, town, file, message)
//     VALUES 
//     ('$name', '$email', '$number', '$birth_date', '$gender', '$town', '$file_name', '$message')";

//     // eksekusi query
//     if (mysqli_query($conn, $query)) {
//         echo "Data berhasil disimpan.";
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
// }

?> -->

<?php
// session_start();

// $conn = mysqli_connect("localhost", "root", "", "lat_pemweb");

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }

// if ($_SERVER["REQUEST_METHOD"] == "POST") {

//     $name = $_POST['name'];
//     $email = $_POST['email'];
//     $number = $_POST['telpon'];
//     $birth_date = $_POST['birthdate'];
//     $gender = $_POST['gender'];
//     $town = $_POST['town'];
//     $message = $_POST['message'];

//     $file_name = time() . "_" . $_FILES['file']['name']; 
//     $tmp_name = $_FILES['file']['tmp_name'];

//     $upload_dir = "uploads/";

//     if (!is_dir($upload_dir)) {
//         mkdir($upload_dir, 0777, true);
//     }

//     move_uploaded_file($tmp_name, $upload_dir . $file_name);

//     $query = "INSERT INTO Messenger 
//     (name, email, number, birth_date, gender, town, file, message)
//     VALUES 
//     ('$name', '$email', '$number', '$birth_date', '$gender', '$town', '$file_name', '$message')";

//     if (mysqli_query($conn, $query)) {
//         // simpan pesan ke session
//         $_SESSION['success'] = "Thank you for your feedback $name 💖";

//         // redirect biar tidak double submit
//         header("Location: index.php");
//         exit();
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }
// }
?>