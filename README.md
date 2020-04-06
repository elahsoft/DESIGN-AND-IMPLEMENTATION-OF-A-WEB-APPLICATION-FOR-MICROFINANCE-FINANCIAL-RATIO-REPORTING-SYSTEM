# DESIGN-AND-IMPLEMENTATION-OF-A-WEB-APPLICATION-FOR-MICROFINANCE-FINANCIAL-RATIO-REPORTING-SYSTEM

This is system that assists a Microfinance Bank to keep record of their financial ratios for every period and generate the financial ratio report for Management.

## Getting Started

To get started there are softwares that needs to be installed.

### Prerequisites

The softwares to be downloaded and installed include:
1. XAMPP for the mysql server, php interpreter software, and the apache server.
2. FPDF.
3. Bootstrap CSS and associated javascripts.
4. Composer for windows.
5. Codeception for the tests

### Installing

1. FPDF should be downloaded and unzipped into the project root directory.
2. Add Bootstrap CSS and associated javascripts in the css and js directory in the project root folder.
3. Use composer to download codeception into the application root folder using the command: composer require "codeception/codeception" --dev

## Running the tests

To run the application, simply follow this steps:
1. Start XAMPP Control Panel
2. Turn on apache and mysql server
3. create a directory inside your c/xampp/htdocs/ folder and name it "management-accounting-suite"
4. Download the project and unzip it into the created directory
5. Open your browser and enter the url localhost/phpmyadmin
6. Create database ratio_analysis using phpmyadmin and import the ratio_analysis.sql file in the root of the application folder into the databse you created.
7. Create a user in phpmyadmin: username as "alvanamfb_admin" and password as "alvanaMFB2018*"
8. Grant priviledges insert, update, select and delete on the database to the user.
9. Download DataTables js and css file and put them in the css and js directory.
10. Download BootstrapCSS and BootstrapJS and put them in the css and js directory.
11. Open your browser and type the url "localhost/management-accounting-suite"  to start the app
10. Sign in using username as "elahsoft" and password as "alvanaMFB2018*"
11. Create a Period and then create financial ratio computations under the period and the use generate report link to view the financial ratio report.
To run the tests, you use the command: vendor\bin\codecept run --steps.


## Built With

* FPDF
* BOOTSTRAP
* Codeception
* Fontawesome
* PHP
* MYSQL
* DataTables

## Authors

* **OPARA FEBECHUKWU CHINONYEREM**


## Acknowledgments

* Alvana Microfinance Bank Ltd for giving me the opportunity to work with them and gain insight for this project.
* Codeception Group
* FontAwesome Group
* SpryMedia Ltd for DataTables
* Twitter for their Bootstrap package
* Olivier PLATHEY for FPDF
