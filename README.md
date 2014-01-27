Magento-Module-Associate-Image
==============================

This is a Magento Module I wrote to associate product images from Configurable products to children products.

I created an index front controller that can be accessed with the path /variationimage. This runs a function that goes through all of the configurable product children items and checks for an image. If no image is found the image from the parent product will be associated with the child product.

This is useful because normally you would have to upload a copy of the image multiple times for each child product. This script automates that process and eliminates redundent files.

Thank you for your time, Christian Ellsworth
