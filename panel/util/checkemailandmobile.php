<?php
function checkReferralByEmailOrPhone(PDO $db, string $email, string $mobile): ?array {
    $stmt = $db->prepare("SELECT id FROM referrals WHERE referred_email = ? OR referred_phone = ?");
    $stmt->execute([$email, $mobile]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false ? $result : null;
}
?>