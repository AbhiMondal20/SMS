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
        // Add more pages and their titles as needed
    );

    // Check if the current page is in the title map
    if (array_key_exists($page, $titleMap)) {
        return $titleMap[$page];
    } else {
        return 'Default Title';
    }
}

// Debugging: Print the page title
// echo "Page Title: " . getPageTitle();
?>
