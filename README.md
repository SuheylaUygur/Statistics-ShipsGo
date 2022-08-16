
<p  align="center"><a  href="https://laravel.com"  target="_blank"><img  src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg"  width="400"></a></p>


  
## About Basic Chart JS & MySQL Queries

  

This project allows you to practice converting a mysql query to a laravel database query and returning the data as json response from the controller and visualizing it with chart.

```diff
! On output page, there are some statistics that observed as a result of querying the database.

+ The first statistics query gives the number of requests in the last six months
+ The second statistics shows the eight most used carriers in the last six months
+ The last two statistics give the five most used ports of loading and five ports of discharges for a company

```

----

We write the parts related to the database connection in laravel .env, in this way we provide a database connection.

	While creating the Laravel project, we use ubuntu and thus we create a wsl connection. Then we write sail up -d command to the terminal to run localhost/login.
