Get Satisfaction PHP Library
===================

This is a PHP helper for the Get Satisfaction API - https://getsatisfaction.com/corp/help/api-resources/

It is modeled after the Twilio PHP Helper library because I think it's generally well done and thought through. This isn't official but should generally work except for the incomplete items in the TODO list below.

It is released under the MIT license.

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
$gs_username = 'username';
$gs_password = 'password';
// It's worth noting that *many* API calls here *don't* require authentication
$client = new Services_GetSatisfaction($gs_username, $gs_password);

// Then we specify a company that we want to get products for
$company = 'companyname';
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
```

### TODO

*  Refactor the getObject & get* methods on the classes that extend Services_GetSatisfaction_ResourceList to eliminate the duplication
*  Implement searching and filtering for Topics, Replies, Companies, People, Products, Tags
*  Implement GET for Replies, Comments, Companies, People
*  Implement authorization for POST & PUT methods for Topics, Tags, Replies
*  Implement error handling across the board

### MIT License

Copyright (C) 2013, Keith Casey <contrib at caseysoftware dot com>

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.