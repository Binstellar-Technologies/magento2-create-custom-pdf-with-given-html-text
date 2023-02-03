## Magento2 Create custom PDF with given HTML & text

> In this blog, we are going to learn how to add a custom PDF in Magento2.

&nbsp;
&nbsp;

> In this example we are going to generate PDF which will be having a custom text & HTML rendered in a PDF file.

&nbsp;
&nbsp;

> Magento2 Custom module to print & download PDF document with custom HTML & text inside it. As of know we have added this button on details page you can even set the page as per your need on any page after making some basic Magento2 changes in code.

&nbsp;
&nbsp;

Wondering how to achieve that? Don't worry we have got the solution for it.

&nbsp;
&nbsp;

> Install our module Binstellar/Productpdf & get the download option on product details page.


## Installation Steps

##### Step 1 : Download the Zip file from Github & Unzip it
##### Step 2 : Create a directory under app/code/Binstellar/Productpdf
##### Step 3 : Upload the files & folders from extracted package to app/code/Binstellar/Productpdf
##### Step 4 : Go to the Magento2 Root directory & run following commands

php bin/magento setup:upgrade

php bin/magento setup:di:compile

php bin/magento setup:static-content:deploy -f

php bin/magento cache:flush

&nbsp;
&nbsp;

##### PDF download link on details page
![image1](https://user-images.githubusercontent.com/123800304/216516080-dc4e0d02-6455-4fd9-8a6d-98efaab34f71.png)

&nbsp;
&nbsp;

##### PDF output

![image2](https://user-images.githubusercontent.com/123800304/216516153-f9944611-867a-4401-93f1-5f92f0eed3f7.png)

&nbsp;
&nbsp;

## Note : We have tested this option in Magento ver. 2.4.5-p1
