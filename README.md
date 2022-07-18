# Nesto
## Magento Practical Test
You will need to build an extension under your name FirstName_LastName. Following are the tasks you need to implement
Create a custom table order_details using declarative schema Columns:
- id
- order_id (entity_id of sales_order table must be foreign key in this table so there
  must be constraint added in the table using declarative schema)
- order_items_count
- order_shipping_amount
- order_grand_total
- addition_info
  Also please rest API endpoints for table like POST for create, PUT for update, Get list, Get by Id and delete operation.
  You need to add one more field "nearest_landmark" in checkout for both shipping and billing address, it should be save against both address and also it should be visible and editable in order address in admin.
  You need to add an event observer against every order placement, order details must be saved against the "order_details" table as mentioned above.

## For Viewing the solution kindly refer to [this link](https://www.loom.com/share/182a850bab2a480db909be4de8596528) for Demo

