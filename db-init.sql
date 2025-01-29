-- Ensure the root user exists and has the correct permissions
ALTER USER 'root'@'%' IDENTIFIED BY 'Ro07P4szW0d-';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;

-- Create a dedicated user for Laravel application connections
CREATE USER IF NOT EXISTS 'gloco_user_db'@'%' IDENTIFIED BY 'Pr0d7ctD4t4Bs3-';
GRANT ALL PRIVILEGES ON gloco1.* TO 'gloco_user_db'@'%';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;