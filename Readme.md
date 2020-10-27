# The EbusDatabase Project 
## What is required to run this project?
### 1. XAMPP
![XAMPP](/Readme/XAMPP.PNG "Official explain")  

[XAMPP](https://www.apachefriends.org/zh_tw/index.html) provides all sections that we need in this project, including **_Apache_** for web server hosting and **_Mysql(MariaDB)_** for database management.
### 2. HeidiSQL (Recommended)
![XAMPP](/Readme/Heidi.PNG "Heldi Screenshot")  
[HeldiSQL](https://www.heidisql.com/) is recommended to import database fast and conveniently, it can also be use to manage database.

### 3. A implemented Database
Until this version of project, the database is still implemented in **local**, it will be modified to use a remote server in the near feature. But **for now you'll need a full copy of database** to make it work as intended.

## How do I deploy the project?

### 1. Install XAMPP
After downloading [XAMPP](https://www.apachefriends.org/zh_tw/index.html) from offical website, by using installer, it should be easy enough. You only have to click next until end, no extra setting has to be modified except you want to change intallation path. [FAQ for Windows](https://www.apachefriends.org/faq_windows.html)
### 2. Deploy html files
After installation completed, go to the path that XAMPP has been installed, should be like **X:/xampp** or the path you modified earlier. Find the directory that named **_htdocs_** inside as shown below.
![htdocs](/Readme/htdocs.PNG)  

And put all files in **_html_ of this project** into **_htdocs_**, done!
### 3. Deploy database files
__Notice: You must have complete install XAMPP first when trying to deploy the databases.__
![XAMPP control panel](/Readme/controlpanel.PNG)

Make sure that both **_Apache_** and **_MySQL_** are turn on, then proceed to open HeidiSQL, this should pop up:  

![Heldi Startup panel](/Readme/HeidiStartup.jpg)

If there exist no workstate, you can add one by clicking the __add__ button. Then choose one workstate, click __open__.  
If everything going well, you should come to this state, click __Files__ on the top-right, then click __loading SQL file...__, pick the .sql file from this project

![Heldi Startup panel](/Readme/HeidiLoad.PNG)
![Heldi Startup panel](/Readme/HeidiLoad2.PNG)

Then there you go!


## How to use?
### 1. Open XAMPP control panel
If XAMPP is installed wihtout error, you should be able to open its control panel through these method  

1.   
![search method](/Readme/search.PNG)  

or  

2.   
![start menu method](/Readme/startmenu.PNG)  

After the panel is showen, turn on **_Apache_** and **_MySQL_** by click *Start* in their column. And it should be like this:
![XAMPP control panel](/Readme/controlpanel.PNG)  

### 2. Open up browser
Open up your browser, enter **_localhost/Vuetest.html_** in the url, and there you go!  

![index](/Readme/url.PNG)  

The front page should only be named as *Vuetest.html* for code reliability, other pages should follow the same rule unless development stage of this project were done.
