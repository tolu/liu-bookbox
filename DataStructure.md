# Data structure

## Classes / tables
### User
* id
* first_name
* last_name
* city
* street
* postal_code
* email
* phone
* credentials
* created_on
* last_login
* password
* image_path
* is_active

### Student
* student_id
* programme
* interests (multivariate)

### Teacher
* teacher_id
* institution

### Book
* id
* isbn10
* isbn13
* title
* description
* published

### Author
* book_isbn
* first_name
* last_name

### Courselitterature
* isbn
* course_code
* Courses
* course_code
* course_name
* course_year
* teacher_id

### Books
* book_id
* isbn
* seller_id
* quality
* added_on
* price
* is_checked_out

### Sales
* book_id
* isbn
* buyer_id
* seller_id
* added_on
* sold_on
* price

### Comment
* id
* user_id
* type
* type_id
* content
* created_on

### Rating
* type
* type_id
* total_sum
* nr_of_ratings
 
### Tags
* isbn
* tag_name
 
### Wishlist
* isbn
* user_id

### Dynamisk information
* isbn_lowest_price (crawla bokpris.nu för att få reda på)
* isbn_nr_for_sale (count(isbn) IN BOOKS)
* isbn_nr_of_sales (count(isbn) IN SALES)
* user_nr_of_sales (count(seller_id) IN SALES)
* user_nr_of_buys (count(buyer_id) IN SALES)