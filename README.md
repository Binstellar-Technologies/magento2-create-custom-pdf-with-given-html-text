## Magento2 Create custom PDF with given HTML & text

> Magento2 Custom module to print & download PDF document with custom HTML & text inside it. As of know we have added this button on details page you can even set the page as per your need on any page after making some basic Magento2 changes in code.

Wondering how to achieve that? Don't worry we have got the solution for it.

> Install our module Binstellar/Productpdf & get the download option on product details page.


## Installation Steps

Step 1 : Download the Zip file from Github & Unzip it
Step 2 : Create a directory under app/code/Binstellar/Productpdf
Step 3 : Upload the files & folders from extracted package to app/code/Binstellar/Productpdf
Step 4 : Go to the Magento2 Root directory & run following commands

php bin/magento setup:upgrade 
php bin/magento setup:di:compile
php bin/magento setup:static-content:deploy -f
php bin/magento cache:flush


## Note : We have tested this option in Magento ver. 2.4.5-p1