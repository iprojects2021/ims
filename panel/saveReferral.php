<?php
include("../includes/db.php");
include("../panel/util/session.php");
// Fetch the name from session
$studentName = isset($_SESSION["user"]["name"]) ? $_SESSION["user"]["name"] : "Student";
?>
<?php


$userid=$_SESSION['user']['id'];

// Check if referral data is provided (email and/or phone)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $referredEmail = isset($_POST['referred_email']) ? $_POST['referred_email'] : null;
    $referredPhone = isset($_POST['referred_phone']) ? $_POST['referred_phone'] : null;

    // Ensure referral data is provided
    if ($referredEmail || $referredPhone) {
        try {
            // Prepare SQL to insert referral into database
            $stmt = $db->prepare("INSERT INTO referrals (userid, referred_email, referred_phone, status) 
                                  VALUES (?, ?, ?, 'Pending')");
            $stmt->execute([$userid, $referredEmail, $referredPhone]);

            // Get the referral ID
            $referralId = $db->lastInsertId();

            echo json_encode(['success' => true, 'referral_id' => $referralId]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error saving referral: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please provide at least an email or phone number']);
    }
}
?>
