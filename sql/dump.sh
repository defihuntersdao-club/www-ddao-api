mysqldump -uroot api  --no-data  --set-gtid-purged=OFF --triggers --routines --events > api.sql