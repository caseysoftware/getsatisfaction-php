<?php

function Services_GetSatisfaction_autoload($className) {
    if (substr($className, 0, 24) != 'Services_GetSatisfaction') {
        return false;
    }
    $file = str_replace('_', '/', $className);
    $file = str_replace('Services/', '', $file);
    return include dirname(__FILE__) . "/$file.php";
}

spl_autoload_register('Services_GetSatisfaction_autoload');

function format_response($input) {
    $pattern =      array(',"',         '{',        '}');
    $replacement =  array(",\n\t\"",    "{\n\t",    "\n}");

    return str_replace($pattern, $replacement, $input);    
}

/**
 * Get Satisfaction API client interface.
 *
 * @category Services
 * @package  Services_GetSatisfaction
 * @author   Keith Casey <contrib@caseysoftware.com>
 * @internal The basic architecture for this was heavily influenced by Neuman Vong's Twilio PHP library.
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_GetSatisfaction extends Services_GetSatisfaction_Resource
{
    const USER_AGENT = 'getsatisfaction-php/0.0.1';

    public function getProducts($company)
    {
        return new Services_GetSatisfaction_Products($this->_username, $this->_password, $company);
    }
    
    public function __call($name, $arguments)
    {
        switch ($name) {
            default:
                throw new Services_GetSatisfaction_ResourceException();
        }
    }
}
/*

=== Companies ===
Get all the public Get Satisfaction communities	/companies
Get all the public Get Satisfaction communities created by the specified user	/people/[user name or ID]/companies
Get all the public Get Satisfaction communities related to the specified product	/products/[product name or ID]/companies
Get the date and time of the last activity in the specified community	/companies/[company name or ID]/last_activity_at

Search	 	 
 	Search for a particular string	?query=[search string] or ?q=[search string]
Show	 	 
 	Show communities that are indexable by search engines, and that also have activity	?show=public
 	Show all communities that are indexable by search engines	?show=not_hidden
 	Show communities that are either not indexable by search engines, or that have no activity	?show=private
 	Show all communities	?show=not_hidden
Sort	 	 
 	Sort by the most recently created community	?sort=recently_created
 	Sort topics by most recent activity	?sort=recently_active
 	Sort alphabetically by the name of the community	?sort=alpha


=== Topics ===
Get a specific topic	/topics/[topic slug or id]
Get all topics in all public Get Satisfaction communities	/topics
Get all topics in a particular community	/companies/[company_name or company_ID]/topics
Get all topics related to a specific product in a particular community	/companies/[company name or ID]/products/[product_name]/topics
Get all topics tagged with a specific tag within a particular community	/companies/[company name or company ID]/tags/[tag]/topics
Get all topics that a particular user has posted (*there is a question about how these numbers are calculated)	/people/[user ID]/topics
Get all topics that a particular user is following	/people/[user ID]/followed/topics
Get all topics identified with a specific product	/products/[product name]/topics

(lots of filter methods)

=== Replies ===
Get all replies to all topics in all public Get Satisfaction communities	/replies
Get all replies from the specified topic	/topics/[topic ID or slug]/replies
Get all replies that a particular user has posted	/people/[user ID]/replies

Return promoted replies (both star promoted and company chosen replies)	?filter=best
Return only star promoted replies	?filter=star_promoted
Return only company promoted replies	?filter=company_promoted
Return all company and star promoted replies	?type=flat_promoted
Exclude comments from the returned replies	?include_comments=false

=== Comments ===
Get all comments from the specified topic	/topics/[topic ID or slug]/comments
Get all comments from the specified reply	/replies/[reply ID or slug]/comments

=== People ===

/people	People with accounts in communities at Get Satisfaction
/people?page=3&limit=10	Goes to page 3 of the people list, showing 10 people. (A limit of 30 is max.)
/companies/[company_name]/employees	Employees of [company_name]
/companies/ [company_name]/people	People who have been active in the  [company_name] community
/people?query=[query_string]	Full text search for [query_string].
/topics/openid_support/people	
People participating in the OpenId Support topic

/people?filter=[variable]	
Filter the people returned by these variables:

    "Visitor" – Has visited the community.

    "Contributor" – Has posted a topic or reply in the community.

    "Employees" – Is an employee of the community.

=== Products ===

/products	All of the products in Get Satisfaction
/products?page=3&limit=10	Goes to page 3 of the product list, showing 10 products. (A limit of 30 is max.)
/products?sort=recently_created           	Products sorted by most recently created.
/products?sort=most_popular	Products sorted by most popular.
/products?sort=least_popular	Products sorted by least popular.
/products?sort=alpha	Products sorted alphabetically.
/products?query=macbook	Full text search for macbook.
/companies/[company_name]/products	Products in the [company_name] community
/people/scott/products	Products scott created
/topics/openid_support/products	Products that the OpenId Support topic is about

=== Tags ===

/tags	All of the tags in Get Satisfaction
/tags?page=3&limit=10	Goes to page 3 of the tag list, showing 10 tags. (A limit of 30 is max.)
/topics/[topic name or ID]/tags           	Tags applied to the specified topic
/companies/[company name or ID]/tags	Return all the tags used on topics in the community


 */