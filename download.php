<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_url = $_POST['video_url'];

    // Extract the video ID from the URL
    $video_id = get_video_id($video_url);

    // Construct the URL of the thumbnail image
    $thumbnail_url = "https://img.youtube.com/vi/{$video_id}/maxresdefault.jpg";

    // Download the thumbnail image to the server
    $thumbnail_file = "thumbnail.jpg";
    file_put_contents($thumbnail_file, file_get_contents($thumbnail_url));

    // Send the thumbnail image to the browser for download
    header('Content-Type: image/jpeg');
    header('Content-Disposition: attachment; filename="' . $thumbnail_file . '"');
    readfile($thumbnail_file);
    exit();
}

function get_video_id($url) {
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    return $query['v'];
}

?>
