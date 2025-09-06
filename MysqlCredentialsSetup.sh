mkdir secrets
echo "password" > secrets/mysql_password.txt
echo "root" > secrets/mysql_root_password.txt
chmod 600 secrets/*.txt
