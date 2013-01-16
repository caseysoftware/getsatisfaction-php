<?php
// First we load the library
require 'Services/GetSatisfaction.php';

// Then we use our Get Satisfaction credentials to authenticate
$gs_username = 'username';
$gs_password = 'password';
// It's worth noting that *many* API calls here *don't* require authentication
$client = new Services_GetSatisfaction($gs_username, $gs_password);

// Then we specify a company that we want to get products for
$company = 'openvbx';
$products = $client->getProducts($company);

echo "There are {$products->count} products here: \n\n";
foreach ($products as $product) {
    echo $product->name . "\n";
    echo $product->url . "\n";

    // From here, we can get the topics associated with each product
    // These are paginated by default
    $topics = $product->getTopics();
    echo "There are {$topics->count} topics here:\n\n";
    foreach ($topics as $topic) {
        echo $topic->subject."\n";
        $tags = $topic->getTags();
        foreach ($tags as $tag) {
            echo $tag->name."\n";
        }
    }
}