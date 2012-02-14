#!sh
#git stash
#git pull origin master
mysql -uadmin -padmin -e "drop database student;"
mysql -uadmin -padmin -e "create database student;"
mysql -uadmin -padmin student < backup/database.sql
mysql -uadmin -padmin -e "UPDATE wp_options SET option_value = 'http://student.dev/' WHERE option_name = 'home' OR option_name = 'siteurl';" student
#git stash pop

