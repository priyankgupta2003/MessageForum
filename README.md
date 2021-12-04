# MessageForum

How to Run:

1. Open Xampp(Use the latest version) control panel
2. Start Apache and Mysql server
3. Copy the php folder under "C:\xampp\htdocs".
4. Click on Admin of MySql
5. Create a Database name "board"
6. Now click Import >> Choose the sql file >> Go
7. Insert the user ID, Password, name and email in database
    Insert Query Syntax: INSERT INTO `users` (`username`, `password`, `fullname`, `email`) VALUES ('user1', MD5('user1_password'), 'user admin', 'user@mail.com');

PLease Note: While inserting the data make sure you are inserting the password in MD5 format otherwise you will get login failed error.
