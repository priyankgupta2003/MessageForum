# MessageForum

How to Run php script:

1. Install latest version of Xampp 
2. Open Xampp control panel
3. Start Apache and Mysql server
4. Copy the php folder under "C:\xampp\htdocs".
5. Click on Admin of MySql
6. Create a Database name "board"
7. Now click Import >> Choose the sql file >> Go
8. Insert the user ID, Password, name and email in database
    Insert Query Syntax: INSERT INTO `users` (`username`, `password`, `fullname`, `email`) VALUES ('user1', MD5('user1_password'), 'user admin', 'user@mail.com');

Please Note: While inserting the data in users table, make sure you are inserting the password in MD5 format otherwise you will get "login failed" error.
