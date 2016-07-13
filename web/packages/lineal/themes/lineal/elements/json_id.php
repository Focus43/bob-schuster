<?php
  //get the publish date
  $dateObj = new \DateTime(Page::getCurrentPage()->getCollectionDatePublic(), new \DateTimeZone('UTC'));

  $payload["@context"] = "http://schema.org/";
  $payload["@type"] = "NewsArticle";
  $payload["name"] =  Page::getCurrentPage()->getCollectionName(); 
  $payload["headline"] =  Page::getCurrentPage()->getCollectionName(); 
  $payload["description"] = Page::getCurrentPage()->getCollectionDescription();
  $payload["datePublished"] = $dateObj->format(\DateTime::ISO8601); 
  $payload["url"] = 'http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
  $payload["author"] = "Bob Schuster";
  $payload["publisher"] = array(
    "@type" => "Organization",
    "name" => "Robert P. Schuster Attorneys at Law"
  );
  
?>
