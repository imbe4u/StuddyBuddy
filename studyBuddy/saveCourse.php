<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["cname"];
    $website = $_POST["cwebsite"];
    $url = $_POST["curl"];

    // Fetch URL content
    $html = @file_get_contents($url);
    if ($html === FALSE) {
        die("Could not fetch URL content.");
    }

    // Extract title
    preg_match("/<title>(.*?)<\/title>/i", $html, $titleMatch);
    $title = $titleMatch[1] ?? $name;

    // Extract thumbnail (og:image)
    preg_match('/<meta property="og:image" content="(.*?)"/i', $html, $imgMatch);
    $thumbnail = $imgMatch[1] ?? 'default.jpg';

    // Create or update JSON file
    $courseFile = "courses.json";
    $courses = file_exists($courseFile) ? json_decode(file_get_contents($courseFile), true) : [];

    $courses[] = [
        "name" => $name,
        "website" => $website,
        "url" => $url,
        "title" => $title,
        "thumbnail" => $thumbnail
    ];

    file_put_contents($courseFile, json_encode($courses, JSON_PRETTY_PRINT));

    header("Location: main.php");
    exit();
}
?>
