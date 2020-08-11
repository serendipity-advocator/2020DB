# The EbusDatabase Project 
## What is required to run this project?
### 1. XAMPP
![XAMPP](/Readme/XAMPP.PNG "Official explain")  

[XAMPP](https://www.apachefriends.org/zh_tw/index.html) provides all sections that we need in this project, including **_Apache_** for web server hosting and **_Mysql(MariaDB)_** for database management.
### 2. A implemented Database
Until this version of project, the database is still implemented in **local**, it will be modified to use a remote server in the near feature. But **for now you'll need a full copy of database** to make it work as intended.

## How do I deploy the project?

### 1. Install XAMPP
After downloading [XAMPP](https://www.apachefriends.org/zh_tw/index.html) from offical website, by using installer, it should be easy enough. You only have to click next until end, no extra setting has to be modified except you want to change intallation path. [FAQ for Windows](https://www.apachefriends.org/faq_windows.html)
### 2. Deploy html files
After installation completed, go to the path that XAMPP has been installed, should be like **X:/xampp** or the path you modified earlier. Find the directory that named **_htdocs_** inside as shown below.
![htdocs](/Readme/htdocs.PNG)  

And put all files in **_html_ of this project** into **_htdocs_**, done!
### 3. Deploy database files
Same as below, first we go to XAMPP's install path **X:/xampp** or the path you modified. However, we go to the **_mysql_** this time, then the **_data_** folder. It should be look like this:  

![databaselocation](/Readme/database.PNG)  

Then copy the whole folder **_ebusproject_ from this project** into **_data_**, done!

## How to use?
### 1. Open XAMPP control panel
If XAMPP is installed wihtout error, you should be able to open its control panel through these method 
1.   
![search method](/Readme/search.PNG)  

or  

2. ![start menu method](/Readme/startmenu.PNG)  

After the panel is showen, turn on **_Apache_** and **_MySQL_** by click *Start* in their column. And it should be like this:
![XAMPP control panel](/Readme/controlpanel.PNG)  

### 2. Open up browser
Open up your browser, enter **_localhost/test.html_** in the url, and there you go!  

![index](/Readme/url.PNG)  

The front page should only be named as *test.html* for code realiablity, other pages should follow the same rule unless development stage of this project were done.
