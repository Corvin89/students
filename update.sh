#!sh
#git stash
#git pull origin master
mysql -ustudent -padmin -e "drop database student;"
mysql -ustudent -padmin -e "create database student;"
mysql -ustudent -padmin student < backup/database.sql
mysql -ustudent -padmin -e "UPDATE wp_options SET option_value = 'http://student.dev/' WHERE option_name = 'home' OR option_name = 'siteurl';" student
#git stash pop

