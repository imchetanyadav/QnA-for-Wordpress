# QnA System for Wordpress
Easily create Question and Answer system to your wordpress site. 

## Features
- Group quiz with category
- Directly add quiz and questions from wordpress admin panel
- Ability to add 1-4 options for each question
 

## Setup Instructions


### Set up database
* Login to your website cpanel
* Open file manager and go to public_html folder. Right click on wp-config.php and Select "View" from menu. Note down value of DB_NAME
* Go back to cpanel and open phpmyadmin
* Click on database earlier noted down
* Create new table named Quiz with 3 columns
* Set columns like these
![Quiz table columns]({{site.baseurl}}//images/quiztable.PNG)
* Create another table named Questions with 8 columns
* Set columns like these
![Questions table columns]({{site.baseurl}}//images/questionstable.PNG)

### Upload pages
* Note down your active theme name
* Open file manager from cpanel
* Go to directory: public_html/wp-content/themes/ACTIVE-THEME_NAME
* Upload quiz.php, quizall.php and questions.php files

### Set page url and styles
* Login to admin panel of your wordpress website
* Create new page with quiz as title and setup page url. Now add styles from quiz.css to this page with the help of plugins like [this](https://wordpress.org/plugins/wp-add-custom-css/)
* IMPORTANT- Select "quiz" as a template from "Page Attributes" 
* Similarly create page for quizall and questions with template quizall and questions respectively.

### Set up database editor
* Add plugin [DB Table Editor](https://wordpress.org/plugins/wp-db-table-editor/)
* Login to cpanel and open file manager. Go to public_html/wp-content/themes/ACTIVE-THEME_NAME. Right click on functions.php and select code-edit. Now add following lines to bottom of file
```php
if(function_exists('add_db_table_editor')){
        add_db_table_editor(array(' id'=>'db1',  'title'=>'Quiz', 'table'=>'quiz', 'sql'=>'SELECT * FROM quiz','cap'=>"edit_others_posts", 'editcap'=>'edit_others_posts', 'id_column'=>'id', 'autoHeight'=>'true'));
        add_db_table_editor(array(' id'=>'db2',  'title'=>'Questions', 'table'=>'questions', 'sql'=>'SELECT * FROM questions','cap'=>"edit_others_posts", 'editcap'=>'edit_others_posts', 'id_column'=>'id', 'autoHeight'=>'true'));
}
wp_register_script( 'dbScript', plugins_url( '/dbScript.js') );
```
* Save file
* Now you must be able to see db table editor option in the menu of your admin panel

### Working with DB Table Editor
* Select quiz or questions from DB Table Editor menu to add content to that specific database
* Inside a database editor page-
* Double click to edit content of a column
* Use first row to filter contents of database
* Use last blank row to add new content to database
* Use red color "-" icon on left to delete row
* When done click on "Save Changes" option to make changes to database

### Structure of quiz table
* id- need not to specify, automatically given
* name- name of the quiz
* category- used to add multiple quiz to a specific category

### Structure of question table
* id- need not to specify, automatically given
* question- add your question to this
* option1 - add option1 to above question here, can be null
* option2 - add option2 to above question here, can be null
* option3 - add option3 to above question here, can be null
* option4 - add option4 to above question here, can be null
* answer - add answer to the question here
* quizid - add id of the quiz to which this question will be added to