<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kalkulasi</title>
    <style>
        /* Styling untuk halaman hasil */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        
        .result-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
            max-width: 400px;
        }
        
        .result {
            font-size: 24px;
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        
        .back-btn {
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
        }
        
        .back-btn:hover {
            background-color: #3d8b40;
        }
        
        .error {
            color: #f44336;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Hasil Perhitungan</h2>
        <div class="result">
            <?php
            // Memeriksa apakah form telah disubmit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Mengambil nilai dari form
                $num1 = $_POST["num1"];
                $operation = $_POST["operation"];
                
                // Inisialisasi variabel hasil
                $result = 0;
                $error = "";
                
                // Validasi input angka pertama
                if (!is_numeric($num1)) {
                    $error = "Angka pertama harus berupa angka!";
                } else {
                    // Untuk operasi yang membutuhkan angka kedua
                    if ($operation !== 'sqrt') {
                        $num2 = $_POST["num2"];
                        
                        // Validasi input angka kedua
                        if (!is_numeric($num2)) {
                            $error = "Angka kedua harus berupa angka!";
                        } else {
                            // Melakukan operasi berdasarkan pilihan user
                            switch ($operation) {
                                case 'add':
                                    $result = $num1 + $num2;
                                    $symbol = "+";
                                    break;
                                case 'subtract':
                                    $result = $num1 - $num2;
                                    $symbol = "-";
                                    break;
                                case 'multiply':
                                    $result = $num1 * $num2;
                                    $symbol = "×";
                                    break;
                                case 'divide':
                                    // Memeriksa pembagian dengan nol
                                    if ($num2 == 0) {
                                        $error = "Tidak bisa dibagi dengan nol!";
                                    } else {
                                        $result = $num1 / $num2;
                                        $symbol = "÷";
                                    }
                                    break;
                                case 'power':
                                    $result = pow($num1, $num2);
                                    $symbol = "^";
                                    break;
                                case 'modulus':
                                    // Memeriksa modulus dengan nol
                                    if ($num2 == 0) {
                                        $error = "Tidak bisa modulus dengan nol!";
                                    } else {
                                        $result = $num1 % $num2;
                                        $symbol = "%";
                                    }
                                    break;
                                default:
                                    $error = "Operasi tidak valid!";
                            }
                            
                            // Menampilkan operasi dengan dua angka
                            if (empty($error)) {
                                echo "$num1 $symbol $num2 = $result";
                            }
                        }
                    } else {
                        // Operasi akar kuadrat (hanya butuh satu angka)
                        if ($num1 < 0) {
                            $error = "Tidak bisa menghitung akar dari bilangan negatif!";
                        } else {
                            $result = sqrt($num1);
                            echo "√$num1 = $result";
                        }
                    }
                }
                
                // Menampilkan pesan error jika ada
                if (!empty($error)) {
                    echo '<span class="error">' . $error . '</span>';
                }
            } else {
                // Jika halaman diakses langsung tanpa submit form
                echo '<span class="error">Tidak ada data yang dikirim!</span>';
            }
            ?>
        </div>
        <!-- Tombol untuk kembali ke kalkulator -->
        <a href="calculator.html" class="back-btn">Kembali ke Kalkulator</a>
    </div>
</body>
</html>