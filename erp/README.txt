2015-11-11
Table => admin/table =>core/tables (DONE)
permision => user/permision => core/permision (DONE)

2015-11-10
module yang jalan:
Table => admin/table =>core/tables
menu => user/menu => core/menus

status => ???

------------
Move controller
admin => core
user => member

2015-10-03
query insert permision
INSERT INTO `bison_inventory`.`mujur_permit` (`id`, `code`, `name`, `created`, `modified`) VALUES (NULL, 'USERADD', 'USER ADD', NOW(), CURRENT_TIMESTAMP), (NULL, 'PERMITADD', 'PERMISION ADD', NOW(), CURRENT_TIMESTAMP)
query Update Permision
UPDATE `bison_inventory`.`mujur_permit` SET `name` = 'USER LIST GRID' WHERE `mujur_permit`.`id` = 1;
Yang boleh di edit nama saja