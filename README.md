# nasa-neo
A user protected website that displays asteroid data, provided by NASA, in a tabular format with external links included. This project demonstrates how to setup and install several components required for deploying a simple customized website.
![login screen](/img/sum_pg.jpg?raw=true)

# features
- Self-hosted website via Apache Web server
- A MySQL users database with hashed passwords and registration mechanism 
- Conditional flags to sanitize input from potential sql injections
- Scripts that processes and display data provided by a third party API
- PHP framework with OOP techniques implemented to store session variables

# requirements
- MySQL database
- Apache web server
- NASA API key

# installation
1. Download XAMPP from official website: https://www.apachefriends.org/download.html
2. Navigate to downloads folder and open 'xampp-(operation system)-(verison number)-installer' and follow installation steps 
3. Open XAMPP control Panel, then start Apache and MySQL
4. Download project from GitHub: https://github.com/trodge0005/nasa-neo/archive/main.zip
5. Extract file into htdocs located in the xampp file on your local disk drive
6. Open browser and Navigate to: http://localhost/phpmyadmin/server_import.php
7. Select 'choose file' and select the users.sql file located in the database folder 
8. Scroll down to bottom of page and select 'GO' to upload file to MySQL
9. Create an API key from NASA at: https://api.nasa.gov/
10. Open 'summary.php' and insert your new API key into the session variable on line 22.
11. Navigate to http://localhost/nasa_neo/login.php and sign in with a demo user or create a new one.
