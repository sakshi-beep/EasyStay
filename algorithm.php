<?php

/**
 * Calculate Jaccard Similarity Index between two sets
 * Jaccard Index = |A ∩ B| / |A ∪ B|
 * 
 * @param array $set1 First set of elements
 * @param array $set2 Second set of elements
 * @return float Similarity score between 0 and 1
 */
function calculateJaccardSimilarity($set1, $set2) {
    if (empty($set1) && empty($set2)) {
        return 1.0; // Both empty sets are identical
    }
    
    if (empty($set1) || empty($set2)) {
        return 0.0; // One empty, one non-empty
    }
    
    $intersection = array_intersect($set1, $set2);
    $union = array_unique(array_merge($set1, $set2));
    
    return count($intersection) / count($union);
}

/**
 * Get facilities for a specific hostel
 * 
 * @param mysqli $con Database connection
 * @param int $hostel_id Hostel ID
 * @return array Array of facility IDs
 */
function getHostelFacilities($con, $hostel_id) {
    $facilities = [];
    
    $query = "SELECT facilities_id FROM `room_facilities` WHERE `room_id` = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $hostel_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $facilities[] = $row['facilities_id'];
    }
    
    mysqli_stmt_close($stmt);
    return $facilities;
}

/**
 * Calculate similarity score between hostels based on facilities and other attributes
 * 
 * @param mysqli $con Database connection
 * @param array $hostel1 First hostel data
 * @param array $hostel2 Second hostel data
 * @return float Combined similarity score
 */
function calculateHostelSimilarity($con, $hostel1, $hostel2) {
    // Get facilities for both hostels
    $facilities1 = getHostelFacilities($con, $hostel1['id']);
    $facilities2 = getHostelFacilities($con, $hostel2['id']);
    
    // Calculate Jaccard similarity for facilities (weight: 70%)
    $facility_similarity = calculateJaccardSimilarity($facilities1, $facilities2);
    
    // Calculate similarity for people capacity (weight: 15%)
    $people_similarity = 1 - (abs($hostel1['people'] - $hostel2['people']) / max($hostel1['people'], $hostel2['people']));
    
    // Calculate similarity for location (weight: 15%)
    $location_similarity = ($hostel1['location'] === $hostel2['location']) ? 1.0 : 0.0;
    
    // Weighted combination
    $total_similarity = ($facility_similarity * 0.70) + ($people_similarity * 0.15) + ($location_similarity * 0.15);
    
    return $total_similarity;
}

/**
 * Get similar hostels for a given hostel
 * 
 * @param mysqli $con Database connection
 * @param int $current_hostel_id Current hostel ID
 * @param int $limit Number of similar hostels to return
 * @return array Array of similar hostels with similarity scores
 */
function getSimilarHostels($con, $current_hostel_id, $limit = 4) {
    // Get current hostel data
    $current_query = "SELECT * FROM `rooms` WHERE `id` = ? AND `status` = 1 AND `removed` = 0";
    $stmt = mysqli_prepare($con, $current_query);
    mysqli_stmt_bind_param($stmt, "i", $current_hostel_id);
    mysqli_stmt_execute($stmt);
    $current_result = mysqli_stmt_get_result($stmt);
    $current_hostel = mysqli_fetch_assoc($current_result);
    mysqli_stmt_close($stmt);
    
    if (!$current_hostel) {
        return [];
    }
    
    // Get all other hostels
    $query = "SELECT * FROM `rooms` WHERE `id` != ? AND `status` = 1 AND `removed` = 0";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $current_hostel_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $similar_hostels = [];
    
    while ($hostel = mysqli_fetch_assoc($result)) {
        $similarity_score = calculateHostelSimilarity($con, $current_hostel, $hostel);
        
        if ($similarity_score > 0) { // Only include hostels with some similarity
            $hostel['similarity_score'] = $similarity_score;
            $similar_hostels[] = $hostel;
        }
    }
    
    mysqli_stmt_close($stmt);
    
    // Sort by similarity score (descending)
    usort($similar_hostels, function($a, $b) {
        return $b['similarity_score'] <=> $a['similarity_score'];
    });
    
    // Return top similar hostels
    return array_slice($similar_hostels, 0, $limit);
}

/**
 * Generate HTML for similar hostels section
 * 
 * @param mysqli $con Database connection
 * @param int $current_hostel_id Current hostel ID
 * @return string HTML content for similar hostels
 */
function generateSimilarHostelsHTML($con, $current_hostel_id) {
    $similar_hostels = getSimilarHostels($con, $current_hostel_id, 4);
    
    if (empty($similar_hostels)) {
        return '<p class="text-center text-muted">No similar hostels found.</p>';
    }
    
    $html = '<div class="row">';
    
    foreach ($similar_hostels as $hostel) {
        // Get hostel image
        $img_query = "SELECT * FROM `room_images` WHERE `room_id` = ? LIMIT 1";
        $stmt = mysqli_prepare($con, $img_query);
        mysqli_stmt_bind_param($stmt, "i", $hostel['id']);
        mysqli_stmt_execute($stmt);
        $img_result = mysqli_stmt_get_result($stmt);
        $img_data = mysqli_fetch_assoc($img_result);
        mysqli_stmt_close($stmt);
        
        $image_src = $img_data ? ROOMS_IMG_PATH . $img_data['image'] : ROOMS_IMG_PATH . "thumbnail.jpg";
        
        // Get facilities for display
        $fac_query = "SELECT f.name FROM `facilities` f 
                      INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id 
                      WHERE rfac.room_id = ?";
        $stmt = mysqli_prepare($con, $fac_query);
        mysqli_stmt_bind_param($stmt, "i", $hostel['id']);
        mysqli_stmt_execute($stmt);
        $fac_result = mysqli_stmt_get_result($stmt);
        
        
        $facilities_html = "";
        $facility_count = 0;
        while (($fac_row = mysqli_fetch_assoc($fac_result)) && $facility_count < 3) {
            $facilities_html .= "<small class='badge bg-light text-dark me-1'>{$fac_row['name']}</small>";
            $facility_count++;
        }
        mysqli_stmt_close($stmt);
        
        $similarity_percentage = round($hostel['similarity_score'] * 100);
        
        $html .= "
        <div class='col-md-6 col-lg-3 mb-4'>
            <div class='card border-0 shadow-sm h-100'>
                <img src='{$image_src}' class='card-img-top' style='height: 200px; object-fit: cover;' alt='{$hostel['name']}'>
                <div class='card-body d-flex flex-column'>
                    <h6 class='card-title'>{$hostel['name']}</h6>
                    <p class='card-text text-muted small mb-2'>
                        <i class='bi bi-geo-alt'></i> {$hostel['location']}
                    </p>
                    <p class='card-text small mb-2'>
                        <i class='bi bi-people'></i> {$hostel['people']} people
                    </p>
                    <div class='mb-2'>
                        {$facilities_html}
                    </div>
                    <div class='mt-auto'>
                        <div class='d-flex justify-content-between align-items-center mb-2'>
                            <strong class='text-primary'>Rs. {$hostel['price']}/night</strong>
                            <small class='text-success'>{$similarity_percentage}% match</small>
                        </div>
                        <a href='room_details.php?id={$hostel['id']}' class='btn btn-sm btn-outline-primary w-100'>View Details</a>
                    </div>
                </div>
            </div>
        </div>";
    }
    
    $html .= '</div>';
    
    return $html;
}

/**
 * Alternative function for getting similar hostels with more detailed scoring
 * This version considers price range as well
 */
function getSimilarHostelsAdvanced($con, $current_hostel_id, $limit = 4) {
    // Get current hostel data
    $current_query = "SELECT * FROM `rooms` WHERE `id` = ? AND `status` = 1 AND `removed` = 0";
    $stmt = mysqli_prepare($con, $current_query);
    mysqli_stmt_bind_param($stmt, "i", $current_hostel_id);
    mysqli_stmt_execute($stmt);
    $current_result = mysqli_stmt_get_result($stmt);
    $current_hostel = mysqli_fetch_assoc($current_result);
    mysqli_stmt_close($stmt);
    
    if (!$current_hostel) {
        return [];
    }
    
    // Get all other hostels
    $query = "SELECT * FROM `rooms` WHERE `id` != ? AND `status` = 1 AND `removed` = 0";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $current_hostel_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $similar_hostels = [];
    
    while ($hostel = mysqli_fetch_assoc($result)) {
        // Get facilities for both hostels
        $facilities1 = getHostelFacilities($con, $current_hostel['id']);
        $facilities2 = getHostelFacilities($con, $hostel['id']);
        
        // Calculate different similarity components
        $facility_similarity = calculateJaccardSimilarity($facilities1, $facilities2);
        
        // People capacity similarity
        $people_similarity = 1 - (abs($current_hostel['people'] - $hostel['people']) / max($current_hostel['people'], $hostel['people']));
        
        // Location similarity
        $location_similarity = ($current_hostel['location'] === $hostel['location']) ? 1.0 : 0.0;
        
        // Price similarity (within 30% range)
        $price_diff = abs($current_hostel['price'] - $hostel['price']);
        $max_price = max($current_hostel['price'], $hostel['price']);
        $price_similarity = 1 - ($price_diff / $max_price);
        $price_similarity = max(0, $price_similarity); // Ensure non-negative
        
        // Weighted combination
        $total_similarity = ($facility_similarity * 0.50) + 
                           ($people_similarity * 0.20) + 
                           ($location_similarity * 0.20) + 
                           ($price_similarity * 0.10);
        
        if ($total_similarity > 0.1) { // Minimum threshold
            $hostel['similarity_score'] = $total_similarity;
            $hostel['facility_similarity'] = $facility_similarity;
            $hostel['people_similarity'] = $people_similarity;
            $hostel['location_similarity'] = $location_similarity;
            $hostel['price_similarity'] = $price_similarity;
            $similar_hostels[] = $hostel;
        }
    }
    
    mysqli_stmt_close($stmt);
    
    // Sort by similarity score (descending)
    usort($similar_hostels, function($a, $b) {
        return $b['similarity_score'] <=> $a['similarity_score'];
    });
    
    return array_slice($similar_hostels, 0, $limit);
}

?>  