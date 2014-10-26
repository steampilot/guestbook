Steampilot Guest Book - A school project

Local Installation
Assuming you have a standard installation of XAMPP:
1 - Extract source files into your htdocs folder of the XAMPP installation.
2 - Rename Config.php.local to Config.php. Leave the remote connection as it is.
3 - Import the database with the guestbook.sql script
4 - Start the application with the following url:
	http://localhost/guestbook/post/index

Remote hosted installation
1 - Extract the source files into your publichtml folder via ftp.
2 - create a mysql database and a corresponding user with full privileges.
3 - Rename Config.php.local to Config.php. and edit the remote connection with text editor.
4 - Start the application with the following url:
	www.yourdomain.com/guestbook/post/index
