eShop
=====

XML and Databases school project.

Requirements
=====


Admin
-----

Login
Logout
Add products
Edit products
Delete products
See a list of purchases from clients
See a list of partners
Get details about local sales and partners sales
Provide a password to your “partner”, so they can upload a link to their webshop’s API
Every time, you add, edit, delete a product from your webshop:

An XML file and JSON file will be generated or updated
The files, will be available to your partners
The files will contain a list of products and related information
The files follow the API rules, so partners are able to parse them In your webshop, you sell local products as well as products from partners. Your website will display:
Your local products fetched directly from the database or from the XML/JSON file
Products from partners. Fetched from the partner’s API (XML and/or JSON)
When a user buys a product (just by clicking the “buy” button):
If the product is local, the client gets an email with purchase information
If the product is local, the system saves the purchase information
If the product is from a partner, the system keeps the commission and sends the order and money (after taking the comission out) to the partner
In your webshop the user will be able to:

Search for products. The page will display local as well as partner’s products
Buy
Get an email when she buys a product In your webshop the partner can:
Login to upload the path to her XML and JSON API
Get an order coming from your own system
Get money from a sale that you make in your system, but the product was from the partner
