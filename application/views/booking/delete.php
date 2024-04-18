<?php
// Mendapatkan data bookingId dari permintaan (jika menggunakan metode POST)
$bookingId = $_POST['bookingId'] ?? null;

// Validasi bookingId, pastikan tidak kosong dan merupakan bilangan bulat positif
if (!empty($bookingId) && is_numeric($bookingId) && $bookingId > 0) {
    // Lakukan operasi penghapusan di sini
    // Contoh: $result = $yourDeleteOperation($bookingId);

    // Set status dan pesan berdasarkan hasil operasi penghapusan
    // Contoh:
    if ($result) {
        $status = "success";
        $message = "Booking deleted successfully.";
    } else {
        $status = "error";
        $message = "Failed to delete booking.";
    }

    // Outputkan respons dalam format JSON
    // echo json_encode(array("status" => $status, "message" => $message));
} else {
    // Jika bookingId tidak valid
    echo json_encode(array("status" => "error", "message" => "Invalid bookingId."));
}
?>