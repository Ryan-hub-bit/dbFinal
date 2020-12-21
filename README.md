# Yarowsky's Movie

Contributors: Kun Liu, William Xu

### Overview

​	Our application domain is a searchable movie database with a user watch history and a recommendation system. The recommendation system will based on watch history using natural language processing. Users will be able to search and add movies to their watched history list, and then have our database with python backend output recommendations based on user watch history. 

​	A video demo of our database running can be found at [Youtube Link](https://youtu.be/hagdfeBO2c0). Screenshots of the results are also included in Section 11. Instructions on how to import and run our project code is included in Section 6. This project is quite finicky as it has various connections between Python packages, PHP, CSS, MySQL, and MacOS specific system paths. We strongly advise the user to use their best judgement to solve any issues that may arise during import. 



### Data 

​	We used the python script located at /python/data_clean.ipynb to preprocess the data to remove weird formatting. We then used excel to split the csv’s into the multiple tables described in Section 12. We imported the tables into our database using the Flat File import function provided by MySQL Workbench. 

NOTE: Due to the extremely finicky nature of the interaction of Python virtual environments, package dependencies, and version compatibility with MySQL and PHP, the user is advised to use their best judgement in running the database and troubleshooting (it took us forever to get it working)

### System/package requirements

- Python:  3.7/3.8
- OS: MacOS (created on MacOS, other platforms not tested)
- Dependencies:  pandas, numpy, scikit-learn, mysql-connector-python
- MySQL: 8.0
-  VS Code: 1.52 (not required, not sure which versions work)



### Brief User Guide

- Download and setup Python virtual environment.
  -  Make sure you have a Python package management system such as conda (anaconda is recommended) downloaded and setup
  - Create a virtual environment in Python 3.7 or 3.8.
  - Install pandas, numpy, scikit-learn and mysql-connector-python in that virtual environment
    -  All dependencies of the above packages must also be installed. The Python package management system should take care of this and any conflicts. 
    - Conda might not be able to install mysql-connector-python correctly. In that case, use pip to install it.
  -  Activate the virtual environment.
    -   Make sure the environment is up and running and all necessary files are in the file path. You may also have to add something to the .bash file. Please use your best judgement to trouble shoot.
    -   Trouble shooting tips:
      - Consult stack overflow
      -  Restart your computer
      -   **Cry**
      - Download and setup MySQL 8.0
      - It is important that it is MySQL 8.0 as support for previous versions of MySQL is not guaranteed in the above installed python packages.   
  - Create and load the database with values. Load the data provided in the .zip file into the database. 
    - The tables are split into separate .csv files in /data.
    - Table schemas can be found below in Section 12. 
    -  We used MySQL Workbench to help create the tables and import the data using flat file import. 
    -  Establish connection between the recommendation.py file and the database.
  - his involves manually going into the recommendation.py file and changing the connection information in the get_recommendations() method. Detailed instructions can be found here: https://dev.mysql.com/doc/connector-python/en/connector-python-api-mysql-connector-connect.html.
  -  Run the provided test_connection() function to ensure that the SQL queries in the python script are running from the correct database. 
  - Run the login.php file. The project should be up and running!

### Database

- Our database provides user-specific specific recommendations based on their watch history.

  o  Recommendations will change as the user adds more movies to their watched list. 

  o  Recommendations are made by using a python backend script that uses the TF-IDF (term frequency inverse document frequency) method from scikit-learn to analyze the importance of each word in a movie’s tagline and compares it across movies to find similarity.

  o  A recommendation score is attached for user reference. Higher score means more similarities with movies on the user’s watched list. 

-  Our database provides functionality for multiple users to maintain their own watched list that is saved across sessions.

  o User can add to, and delete from their watched list.

  o User watched list is saved across sessions, so they can log back on and add to their list at a later date using their user_id.

- Our database provides allows users the options to select what information they want to see about the movies they are searching up. 

  o  Users can select to see movie economic data (budget, revenue), movie ratings (popularity, user ratings),  or movie details (tagline, genre).

- The GUI of our database – although far from perfect – holds a few subtle refinements. 

  o  Movies results are returned in a manageable 15 entries per page, with the option of going onto the next page if you want more results, and the option of going back to the previous page.

  o  Some search options involve dropdown menus and checkboxes. This design choice was a form of limiting user input to ensure valid inputs.

  o  Tabs on top to quickly navigate to different pages.

### 
