
# RTC BUS TATKAL 

Team No 11 -

members:

Aluvala Nikhil                       - BL.EN.U4CSE18002 

Bachu Krishna Lokesh                 - BL.EN.U4CSE18011 

Golla Sai Venkatesh                  - BL.EN.U4CSE18037 

Kudipudi Venkat Ajay                 - BL.EN.U4CSE18056 

Kuppala Venkat Vinay Babu            - BL.EN.U4CSE18057 

 

Project Description: 

      This website is useful for booking tickets even when it is dispatched from the source. In the situation of emergence for a travel by bus at night, a person can’t book a ticket for his/her travel. This website helps the person to give him the details of the vacancy of seats on the bus, he/she needs to travel. So, this website makes the person to know that there is an empty seat to travel and at the same time he/she can book the ticket. 

 

Domain - Bus Seat Reservation System 

 

Basic functionalities: 

This project “RTC BUS TATKAL” consists of three user interfaces namely they are user interface, admin interface and driver interface 


Languages/Technologies used: 

Frontend: HTML, CSS, bootstrap, java script 

Backend: database-MySQL 

Frontend –Backend connection: php 
 

Software requirements: google chrome (any browser not specific), install xampp server (version=3.2.4), visual studio as editor 

 

Functions: 

Admin 

Add Bus 

Delete Bus 

Add seats 

Add stops 

 

Driver/ Co-driver 

Check the details of a Passenger like Source and destination.  

Book the seats for passengers. 


Passenger 

Can check the Seat Vacancy of bus. 

Book seat for travel. 


How it starts: 

1)Open xampp server and start apache and MySQL. 

2)In the MySQL row we have an option named admin (click on it to get the phpMyAdmin). 

3)Here we need to take care of apache that ports are free for it. 

4)In the phpMyAdmin we need to create a database and name it as a bus. 

5)Place this entire folder in htdocs, in xampp(xampp path as per your installation). 

6)Open index.php in Visual Studio code. Now give the right click on the file name and copy the path. 

7)paste the path on browser and delete everything that present before the folder name and write localhost:80. 

8)Now you will get the page what you want. 


How it works: 

 In the login page we have three interfaces for users, they are driver, admin, user. Passwords need to be at least six digits. These users will have a separate interface and they get their respective pages through their credentials. 

If you are a  

User:  

First of all, when user visits the website, if user is new to the website, he /she needs to get into sign up page (Full name, username, password, confirm password) for creating an account that leads to sign in page (username, password) where we need to login with our credentials else if the user is already registered then user just need to login.You will get a main page where you need to give your source, destination and your travelling date. Then we will get all the available buses in bus details page and click on the book now option for your required bus.You will get the page on the seats. You will have a total of 36 seats. You need to select from among the seats. As a user you can select any no of the seats. Here in this page, we have available seats (Green in colour), already booked (Red in colour), Selected seats (Red in colour). After selecting the tickets click on the ‘Book seats’ option and then click on ‘check out’ option. Then you will get the details page where you need to give information about passengers (one or many based on your booking). There you need to give name, gender, age email and then click on submit. Then you will get a final page where you can see the statement that your booking is successful and also booking id is also visible to the user. 


Admin: 

There is only admin where he/she logs in through the sign in page and the admin will get the admin page where he/she can add buses, delete buses, add stops (source and destination), add seats. (To access admin page , you should signup using username "saivenkatesh" and password of your choice and sign in with same details as this is a project).There admin will have home, Driver and buses (add buses, delete buses), seats, stops. If we go to add buses, we will get the add bus page first we need to click on add driver (because primary key of driver table is present as foreign key in bus table) option in that page, then you will get into the driver page after that admin will need to give to enter driver details (full name, driver id, password, confirm password). After that click on the bus option where admin will be redirected to add bus page the give the details of bus (Bus number, no of seats, Bus type, source type, Source, Destination, Source id) and click on submit. Now admin is able to add the bus. If admin clicks on the seats option then admin will get the seats page where admin needs to give bus number and no of seats in the bus. If admin clicks on stop option admin will get the stops page where admin needs to give details of stop, they are bus no, stop id, stop name, arrival time (in hours:min:seconds format), Fare. Then save it. If admin clicks on delete option, he leads to delete bus page where admin need to enter bus no and save it. Now Admin has control over deleting buses, adding buses, seats and stops. 


Driver: 

To access driver page, you should ask admin for signing up as driver and admin will assign you a bus.Driver can only view the seats of his respective bus.(You only can sign in as admin , add driver and add bus as this is a project) .Based on the booking id given by the passenger the driver can check the details of passengers. And also, the driver can book the tickets even for the passengers who didn’t booked the tickets.  But the difference between the driver and customer is the driver can book the seats until the bus reaches the destination but customer can book the seats only before the arrival time of the bus in the respective stop. 

 

Result: 

Now a person will be able to book a ticket even when the bus starts moving from source. 

 

 

 

 

. 