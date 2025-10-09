<?php
function checkReferralByEmailOrPhone(PDO $db, string $email, string $mobile): ?array {
    $stmt = $db->prepare("SELECT id FROM referrals WHERE referred_email = ? OR referred_phone = ?");
    $stmt->execute([$email, $mobile]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false ? $result : null;
}

function insertReferralByEmailOrPhone(PDO $db, string $email, string $mobile)
{
    // 1️⃣ Find the referrer (who referred this user)
    $stmt = $db->prepare("SELECT referredby FROM users WHERE email = ? OR contact = ?");
    $stmt->execute([$email, $mobile]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || empty($user['referredby'])) {
        // No referrer found
        return null;
    }

    $referredBy = $user['referredby'];

    // 2️⃣ Get referrer’s user ID
    $stmt = $db->prepare("SELECT id, email, contact FROM users WHERE id = ?");
    $stmt->execute([$referredBy]);
    $referrer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$referrer) {
        // Referrer not found
        return null;
    }

    $userid = $referrer['id'];
    $referredEmail = $referrer['email'];
    $referredPhone = $referrer['contact'];

    // 3️⃣ Insert referral record
    $stmt = $db->prepare("
        INSERT INTO referrals (userid, referred_email, referred_phone, status)
        VALUES (?, ?, ?, 'Enrolled')
    ");
    $stmt->execute([$userid, $referredEmail, $referredPhone]);

    // 4️⃣ Return the last inserted referral ID
    return $db->lastInsertId();
}


?>