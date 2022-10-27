SELECT * FROM `department`

INSERT INTO `department` (
    `dep_name`, 
    `dep_employeeid`, 
    `dep_createdon`, 
    `dep_modifiedon`
) 
VALUES
    ('Logistic', 8, NOW(), NOW()),
    ('IT', 9, NOW(), NOW()),
    ('Finance', 10, NOW(), NOW()),
    ('Finance', 11, NOW(), NOW());


INSERT INTO `employee` (
    `emp_firstname`,
    `emp_lastname`,
    `emp_createdon`,
    `emp_modifiedon`
) 
VALUES 
    ( 'Jacklyn', 'Ng', NOW(), NOW()), //8
    ( 'Kingston', 'Chong', NOW(), NOW()), //9
    ( 'Ngow', 'Ling', NOW(), NOW()), // 10
    ( 'YanKan', 'Lee', NOW(), NOW()); //11

INSERT INTO `leave` (
    `lea_employeeid`,
    `lea_status`,
    `lea_num`,
    `lea_createdon`,
    `lea_modifiedon`
) 
VALUES 
    ( '1', '1', 1, NOW(), NOW()), 
    ( '1', '2', 2, NOW(), NOW()), 
    ( '1', '1', 1, NOW(), NOW()), 
    ( '4', '3', 3, NOW(), NOW()), 
    ( '4', '1', 1, NOW(), NOW()), 
    ( '4', '4', 4, NOW(), NOW()), 
    ( '4', '2', 2, NOW(), NOW()), 
    ( '4', '3', 3, NOW(), NOW());


/* Hydrahon SQL Grouped where */
 select * from `people` 
 where `is_admin` = 1 
 or ( 
    ( `is_active` = 1 and `is_moderator` = 1 ) 
    or 
    ( `is_active` = 1 and `deleted_at` is NULL and  `email_confirmed_at` is not NULL ) 
)

SELECT
    `emp_firstname` as `efname`,
    `emp_lastname` as `elname`,
    `emp_createdon`,
    `emp_modifiedon`,
    `lea_status` as `Leave Type`
FROM `employee`
LEFT JOIN `leave` ON `emp_id` = `lea_employeeid`
ORDER BY `emp_createdon` DESC



CREATE TABLE salary (
    sal_id SMALLINT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sal_employeeid SMALLINT(6) NOT NULL,
    sal_salary SMALLINT(30) NOT NULL,
    sal_createdon DATETIME,
    sal_modifiedon DATETIME
);

ALTER TABLE salary
ADD sal_

INSERT INTO `salary` (
    `sal_employeeid`,
    `sal_salary`,
    `sal_monthofsalary`,
    `sal_createdon`,
    `sal_modifiedon`
) 
VALUES 
    ( '1', '5500', '2021-09', NOW(), NOW()), 
    ( '2', '5300', '2021-09', NOW(), NOW()), 
    ( '3', '3000', '2021-09', NOW(), NOW()), 
    ( '4', '3500', '2021-09', NOW(), NOW()), 
    ( '7', '1500', '2021-09', NOW(), NOW()), 
    ( '8', '4220', '2021-09', NOW(), NOW()), 
    ( '9', '2220', '2021-09', NOW(), NOW()), 
    ( '10', '3010', '2021-09', NOW(), NOW()),
    ( '11', '1300', '2021-09', NOW(), NOW()),
    ( '12', '1700', '2021-09', NOW(), NOW());