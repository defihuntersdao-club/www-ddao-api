CREATE USER 'defihuntersdao-api'@'%' IDENTIFIED WITH mysql_native_password BY 'apiddao';
GRANT ALL PRIVILEGES ON api.* TO 'defihuntersdao-api'@'%';
FLUSH PRIVILEGES;