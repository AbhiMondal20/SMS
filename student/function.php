<?php
function getPageTitle() {
    // Get the current page filename
    $page = basename($_SERVER['PHP_SELF']);

    // Define a map of page titles
    $titleMap = array(
        'index.php' => 'Dashboard',
        'courses.php' => 'Course Management Listing',
        'sessions.php' => 'Session Management Listing',
        'batches.php' => 'Batches Management Listing',
        'fees-head.php' => 'Fees Head Management Listing',
        'user.php' => 'User Management Listing',
        'monthly-fees.php' => 'Monthly Fees Management Listing',
        'edit-monthly-fees.php' => 'Update Fees Management Listing',
        'counter-collection.php' => 'Counter Collection',
        'student.php' => 'Manage Student',
        'edit-student.php' => 'Update Student Manage',
        'student-upload-document.php' => 'Student Document',
        'site-info.php' => 'Website Info',
        'counter-receipt.php' => 'Counter Receipt',
        'payment-history.php' => 'Payment History',
        'counter-cancellation-history.php' => 'Cancelleation History',
        'student-ledger-report.php' => 'Student Ledger Report'
        
    );

    if (array_key_exists($page, $titleMap)) {
        return $titleMap[$page];
    } else {
        return 'Default Title';
    }
}

// Debugging: Print the page title
// echo "Page Title: " . getPageTitle();
?>
