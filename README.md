getsatisfaction-php
===================

This is a PHP helper for the Get Satisfaction API.

It is modeled after the Twilio PHP Helper library because I think it's generally well done and thought through.

### Download the source code

[Click here to download the source
(.zip)](https://github.com/caseysoftware/getsatisfaction-php/zipball/master) which includes all
dependencies.

Once you download the library, move the Services folder to your project
directory and then include the library file:

    require 'Services/GetSatisfaction.php';

```php
<?php
// First we load the library
require 'Services/GetSatisfaction.php';
// Then we use our Get Satisfaction credentials to authenticate
// It's worth noting that *many* API calls here *don't* require authentication
$client = new Services_GetSatisfaction($gs_username, $gs_password);

// Then we specify a company that we want to get products for
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
    }
}
```