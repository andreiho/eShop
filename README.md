eShop
=====

XML and Databases school project.

DEMO
====
http://eshop.andreihorodinca.dk/

Requirements
=====

Admin
-----

- Login.
- Logout.
- Add products directly to the database.
- Edit products directly from the database.
- Delete products.
- See a list of purchases from clients.
- See a list of partners.

Every time, you add, edit, delete a product from your webshop:
----

- An XML file and JSON file will be generated or updated.
- The files will be available to your partners.
- The files will contain a list of products and related information.
- The files follow the API rules, so partners are able to parse them.

Your webshop will display:
----

- Your partner’s products from XML and/or JSON and save them into your own database.
- Your local products fetched directly from own database.
- Products from partners will also be fetched from your own database.

When a user buys a product:
----

- If the product is local, the client gets an email with purchase information.
- If the product is local, the system saves the purchase information.
- If the product is from a partner, the system keeps the commission and sends the order and money (after taking the comission out) to the partner. This is done with a web-service.

In your webshop the customer will be able to:
----

- Search for products. The page will display local as well as partner’s products.
- Buy (click and buy, no payment, no credit card, just pretend the user entered all needed data).
- Get an email when they buy a product. The buyers must write their email somewhere. If you want, the client also writes their mobile number to get an SMS with the order.

In your webshop the partner can:
----

- Login to upload the path to their XML and JSON API.
- Get an order coming from your own system.
- Get money from a sale that you make in your system, but the product was from the partner.
