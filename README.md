# Magento 2 Custom Stock Status GraphQL

[Mageplaza Custom Stock Status for Magento 2](https://www.mageplaza.com/magento-2-custom-stock-status/) is a useful tool to inform customers about the products' availability. 

When visiting a store, customers will not only want to know the prices but also the quantity of products they are interested in. In some stores with no clear display of product statuses, customers will usually know that the item is out of stock or not many available until they click add to cart. It's definitely a frustrating experience for customers and a waste of time. 

Unlike the Magento 2 Default, Mageplaza Custom Stock Status enables the store admins to create unlimited stock status labels for products, such as In-stock, Out-of-stock, Coming soon, Available next week, etc. The stock labels can be added to the specific products without limitations. The store admin can configure to display the stock label based on the real-time situation of the product quantity from the admin backend. Therefore, the stock label will be displayed with each product, exactly how it is in your store in real-time. 

With this extension, the store admin doesn't have to edit the stock label manually, as it can be automatically updated based on the change in product quantity ranges. It's easy and flexible to set up at the backend. For example, the admin can set the rules that when only one item available, the stock label will display as "Hurry up! Only one item left."

Magento 2 Custom Stock Status supports all types of products, including simple products, configurable products, group products, and bundle products. When customers select the attributes of a product to filter out the item that matches their requirements, the appropriate stock label will appear depending on that item's status. For example, if there is only one T-shirt size S, the white color left in stock, the label can be "Hurry up! Last item."

The store admin can add a stock label to the most common positions on the store site, including product listing page, product detail page, shopping cart page, and product widget block. Besides, the extension enables adding images to the stock label to make it more outstanding and attractive. 

Especially, **Magento Custom Stock Status GraphQL is a part of Mageplaza Custom Stock Status extension that adds GraphQL features, this supports for PWA studio.** Mageplaza Custom Stock Status Extension now supports getting and pushing data on the website with GraphQL

## 1. How to install

Run the following command in Magento 2 root folder:

```
composer require mageplaza/module-custom-stock-status-graphql
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```

**Note:** Magento 2 Custom Stock Status GraphQL requires installing [Mageplaza Custom Stock Status](https://www.mageplaza.com/magento-2-custom-stock-status/) in your Magento installation. 

## 2. How to use

To perform GraphQL queries in Magento, please do the following requirements: 
- Use Magento 2.3.x or higher. Set your site to [developer mode](https://www.mageplaza.com/devdocs/enable-disable-developer-mode-magento-2.html).
- Set GraphQL endpoints as `http://<magento2-server>/graphql` in url box, click **Set endpoint**. 
(e.g. `http://dev.site.com/graphql`)
- To view the queries that the Mageplaza Custom Stock Status GraphQL extension supports, you can look in `Docs > Query` in the right corner. 

## 3. Devdocs

- [Custom Stock Status API & examples](https://documenter.getpostman.com/view/10589000/SzfCVSAQ?version=latest)
- [Magento 2 Custom Stock Status GraphQL & examples](https://documenter.getpostman.com/view/10589000/SzfDvjfh?version=latest)

Click on Run in Postman to add these collections to your workspace quickly. 

![Magento 2 blog graphql pwa](https://i.imgur.com/lhsXlUR.gif)

## 4. Contribute to this module 

Feel free to **Fork** and contribute to this module. Create a pull request, so we will merge your changes to the main branch. 

## 5. Get Support 

- Feel free to contact us if you have any further questions. 
- If you like this project, please give us a **Star** ![star](https://i.imgur.com/S8e0ctO.png)
