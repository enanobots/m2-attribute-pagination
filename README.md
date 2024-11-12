![Open Source Love](https://img.shields.io/badge/open-source-lightgrey?style=for-the-badge&logo=github)
![](https://img.shields.io/badge/Magento-2.2.x-orange?style=for-the-badge&logo=magento)
![](https://img.shields.io/badge/Magento-2.3.x-orange?style=for-the-badge&logo=magento)
![](https://img.shields.io/badge/Magento-2.4.x-orange?style=for-the-badge&logo=magento)
![](https://img.shields.io/badge/Maintained-yes-gren?style=for-the-badge&logo=magento)

### Magento 2 Attribute Options Pagination

Simple Magento 2 module that adds pagination to attribute options in admin panel.

[![5r8Sf9.md.png](https://iili.io/5r8Sf9.md.png)](https://freeimage.host/i/5r8Sf9)

Installation (in your Magento 2 directory):\
**THIS PACKAGE REQUIRES COMPOSER 2.x** 
```bash
composer require enanobots/m2-attribute-pagination  --ignore-platform-reqs
```

activate the module:
```bash
php bin/magento module:enable Nanobots_AttributeOptionPager
```

And run upgrade command:
```bash
php bin/magento setup:upgrade
```

Module should work out-of-the box

### Tested on:
- Magento 2.3.6 Open Source
- Magento 2.3.7 Open Source
- Magento 2.4.2 Open Source
- Magento 2.4.3 Open Source
- Magento 2.4.7 Open Source

If there are issues / problems, please open an issue within the repository or submit a pull request.