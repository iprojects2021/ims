<?php
function checkReferralByEmailOrPhone(PDO $db, string $email, string $mobile): ?array {
    $stmt = $db->prepare("SELECT id FROM referrals WHERE referred_email = ? OR referred_phone = ?");
    $stmt->execute([$email, $mobile]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result !== false ? $result : null;
}

// function insertReferralByEmailOrPhone(PDO $db, string $email, string $mobile)
// {
//     // 1️⃣ Find the referrer (who referred this user)
//     $stmt = $db->prepare("SELECT referredby FROM users WHERE email = ? OR contact = ?");
//     $stmt->execute([$email, $mobile]);
//     $user = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$user || empty($user['referredby'])) {
//         // No referrer found
//         return null;
//     }

//     $referredBy = $user['referredby'];

//     // 2️⃣ Get referrer’s user ID
//     $stmt = $db->prepare("SELECT id, email, contact FROM users WHERE id = ?");
//     $stmt->execute([$referredBy]);
//     $referrer = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$referrer) {
//         // Referrer not found
//         return null;
//     }

//     $userid = $referrer['id'];
//     $referredEmail = $referrer['email'];
//     $referredPhone = $referrer['contact'];

//     // 3️⃣ Insert referral record
//     $stmt = $db->prepare("
//         INSERT INTO referrals (userid, referred_email, referred_phone, status)
//         VALUES (?, ?, ?, 'Enrolled')
//     ");
//     $stmt->execute([$userid, $referredEmail, $referredPhone]);

//     // 4️⃣ Return the last inserted referral ID
//     return $db->lastInsertId();
// }

function insertReferralByEmailOrPhone(PDO $db, string $email, string $mobile)
{
    // Enable error mode to catch SQL issues
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1️⃣ Get the referredby (refer code) from the user who signed up
    $stmt = $db->prepare("SELECT referredby FROM users WHERE email = ? OR contact = ?");
    $stmt->execute([$email, $mobile]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || empty($user['referredby'])) {
        // No referral used
        return null;
    }

    $referCodeUsed = $user['referredby']; // e.g. "SS-62OMWH"

    // 2️⃣ Find the referrer (the one who owns that refer code)
    $stmt = $db->prepare("SELECT id, email, contact FROM users WHERE refercode = ?");
    $stmt->execute([$referCodeUsed]);
    $referrer = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$referrer) {
        // Invalid or expired refer code
        return null;
    }

    $userid = $referrer['id'];
    $referredEmail = $referrer['email'];
    $referredPhone = $referrer['contact'];

    // 3️⃣ Insert referral record
    try {
        $stmt = $db->prepare("
            INSERT INTO referrals (userid, referred_email, referred_phone, status)
            VALUES (?, ?, ?, 'Enrolled')
        ");
        $stmt->execute([$userid, $referredEmail, $referredPhone]);

        return $db->lastInsertId();
    } catch (PDOException $e) {
        echo "Insert failed: " . $e->getMessage();
        return null;
    }
}

?>