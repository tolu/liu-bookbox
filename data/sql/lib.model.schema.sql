
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`fname` VARCHAR(255),
	`lname` VARCHAR(255),
	`city` VARCHAR(255),
	`street` VARCHAR(255),
	`postal_code` VARCHAR(255),
	`email` VARCHAR(255),
	`phone` VARCHAR(255),
	`credentials` VARCHAR(255),
	`created_on` DATETIME,
	`last_login` DATETIME,
	`password` VARCHAR(255),
	`image_path` TEXT,
	`is_active` TINYINT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- student
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `student`;


CREATE TABLE `student`
(
	`student_id` INTEGER,
	`programme` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `student_FI_1` (`student_id`),
	CONSTRAINT `student_FK_1`
		FOREIGN KEY (`student_id`)
		REFERENCES `student` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- teacher
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `teacher`;


CREATE TABLE `teacher`
(
	`teacher_id` INTEGER,
	`institution` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `teacher_FI_1` (`teacher_id`),
	CONSTRAINT `teacher_FK_1`
		FOREIGN KEY (`teacher_id`)
		REFERENCES `teacher` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- author
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `author`;


CREATE TABLE `author`
(
	`isbn10` VARCHAR(10)  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	PRIMARY KEY (`isbn10`,`name`),
	CONSTRAINT `author_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- book
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `book`;


CREATE TABLE `book`
(
	`isbn10` VARCHAR(10)  NOT NULL,
	`isbn13` BIGINT,
	`title` VARCHAR(255),
	`description` TEXT,
	`imagePath` TEXT,
	`published` DATETIME,
	PRIMARY KEY (`isbn10`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- booksForSale
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `booksForSale`;


CREATE TABLE `booksForSale`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`isbn10` VARCHAR(10),
	`seller_id` INTEGER,
	`bookquality` INTEGER,
	`added_on` DATETIME,
	`price` FLOAT,
	`is_checked_out` DATETIME,
	`checked_out_by` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `booksForSale_FI_1` (`isbn10`),
	CONSTRAINT `booksForSale_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`),
	INDEX `booksForSale_FI_2` (`seller_id`),
	CONSTRAINT `booksForSale_FK_2`
		FOREIGN KEY (`seller_id`)
		REFERENCES `user` (`id`)
		ON DELETE CASCADE,
	INDEX `booksForSale_FI_3` (`checked_out_by`),
	CONSTRAINT `booksForSale_FK_3`
		FOREIGN KEY (`checked_out_by`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;


CREATE TABLE `comment`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`isbn10` VARCHAR(10),
	`content` TEXT,
	`created_on` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `comment_FI_1` (`user_id`),
	CONSTRAINT `comment_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	INDEX `comment_FI_2` (`isbn10`),
	CONSTRAINT `comment_FK_2`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- rating
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rating`;


CREATE TABLE `rating`
(
	`type` VARCHAR(255),
	`type_id` VARCHAR(10),
	`total_sum` INTEGER,
	`created_on` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `rating_FI_1` (`type_id`),
	CONSTRAINT `rating_FK_1`
		FOREIGN KEY (`type_id`)
		REFERENCES `book` (`isbn10`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- sales
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sales`;


CREATE TABLE `sales`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`isbn10` VARCHAR(10),
	`buyer_id` INTEGER,
	`seller_id` INTEGER,
	`added_on` DATETIME,
	`sold_on` DATETIME,
	`price` FLOAT,
	PRIMARY KEY (`id`),
	INDEX `sales_FI_1` (`isbn10`),
	CONSTRAINT `sales_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`),
	INDEX `sales_FI_2` (`buyer_id`),
	CONSTRAINT `sales_FK_2`
		FOREIGN KEY (`buyer_id`)
		REFERENCES `user` (`id`),
	INDEX `sales_FI_3` (`seller_id`),
	CONSTRAINT `sales_FK_3`
		FOREIGN KEY (`seller_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- bookInCategory
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bookInCategory`;


CREATE TABLE `bookInCategory`
(
	`isbn10` VARCHAR(10),
	`category_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `bookInCategory_FI_1` (`isbn10`),
	CONSTRAINT `bookInCategory_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`),
	INDEX `bookInCategory_FI_2` (`category_id`),
	CONSTRAINT `bookInCategory_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wishlist
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wishlist`;


CREATE TABLE `wishlist`
(
	`isbn10` VARCHAR(10),
	`user_id` INTEGER,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `wishlist_FI_1` (`isbn10`),
	CONSTRAINT `wishlist_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`),
	INDEX `wishlist_FI_2` (`user_id`),
	CONSTRAINT `wishlist_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- courses
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `courses`;


CREATE TABLE `courses`
(
	`id` VARCHAR(255)  NOT NULL,
	`course_name` VARCHAR(255),
	`course_year` VARCHAR(255),
	`user_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `courses_FI_1` (`user_id`),
	CONSTRAINT `courses_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- courselitterature
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `courselitterature`;


CREATE TABLE `courselitterature`
(
	`isbn10` VARCHAR(10),
	`course_code` VARCHAR(255),
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `courselitterature_FI_1` (`isbn10`),
	CONSTRAINT `courselitterature_FK_1`
		FOREIGN KEY (`isbn10`)
		REFERENCES `book` (`isbn10`),
	INDEX `courselitterature_FI_2` (`course_code`),
	CONSTRAINT `courselitterature_FK_2`
		FOREIGN KEY (`course_code`)
		REFERENCES `courses` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
