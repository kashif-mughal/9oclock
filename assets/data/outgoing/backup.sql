UPDATE `users` AS `a`,`user_login` AS `b` SET `a`.`first_name` = 'Mughl2', `a`.`email` = '', `a`.`last_name` = 'mk', `b`.`username` = '',`a`.`logo` = '' WHERE `a`.`user_id` = 'bd1911dbb017a201d471' AND `a`.`user_id` = `b`.`user_id`;
INSERT INTO `user_login` (`user_id`, `user_type`, `status`, `username`, `password`) VALUES ('200d5643592e2946b43b', 1, 1, 'mkmughal001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `email`, `address`, `status`, `AddressId`, `address_details`, `is_promotion`) VALUES ('200d5643592e2946b43b', 'kasdfhi', 'mughal', '+449937338737', 'mkmughal001@gmail.com', 'asldkf', 1, 0, '', 1);
INSERT INTO `grocery_user_address` (`Address`, `zip_code`, `town`, `city`, `UserId`, `Status`) VALUES ('asldkf', 'lsdkf', 'lskdf', 'lkasdf', '200d5643592e2946b43b', 1);
UPDATE `users` AS `a`,`user_login` AS `b` SET `a`.`first_name` = 'kashif', `a`.`email` = '', `a`.`last_name` = 'mughal', `b`.`username` = '',`a`.`logo` = '' WHERE `a`.`user_id` = '200d5643592e2946b43b' AND `a`.`user_id` = `b`.`user_id`;
INSERT INTO `user_login` (`user_id`, `user_type`, `status`, `username`, `password`) VALUES ('25d1b9bb187bdda302f9', 1, 1, 'mkmughal001@gmail.com', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `email`, `address`, `status`, `AddressId`, `address_details`, `is_promotion`) VALUES ('25d1b9bb187bdda302f9', 'sd', 'sdf', '+444543232342', 'mkmughal001@gmail.com', 'sdf', 1, 0, '', 1);
INSERT INTO `grocery_user_address` (`Address`, `zip_code`, `town`, `city`, `UserId`, `Status`) VALUES ('sdf', 'sdf', 'sfd', 'sdf', '25d1b9bb187bdda302f9', 1);
UPDATE `users` AS `a`,`user_login` AS `b` SET `a`.`first_name` = 'kashif', `a`.`email` = 'mkmughal001@gmail.com', `a`.`last_name` = 'mughal', `b`.`username` = 'mkmughal001@gmail.com',`a`.`logo` = '' WHERE `a`.`user_id` = '25d1b9bb187bdda302f9' AND `a`.`user_id` = `b`.`user_id`;
INSERT INTO `user_login` (`user_id`, `user_type`, `status`, `username`, `password`) VALUES ('caa0e18c6d8dc6ab8f47', 1, 1, 'Qari@9oclockshop.co.uk', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone`, `email`, `address`, `status`, `AddressId`, `address_details`, `is_promotion`) VALUES ('caa0e18c6d8dc6ab8f47', 'Qari', '--', '+443333333333', 'Qari@9oclockshop.co.uk', 'abcd', 1, 0, '', 1);
INSERT INTO `grocery_user_address` (`Address`, `zip_code`, `town`, `city`, `UserId`, `Status`) VALUES ('abcd', 'GN1', 'ab2', 'ab3', 'caa0e18c6d8dc6ab8f47', 1);
INSERT INTO `grocery_otp` (`email_address`, `code`, `expiry_date`, `verified`) VALUES ('Qari@9oclockshop.co.uk', 9491, '2021-11-04 15:52:09', 0);
UPDATE `grocery_otp` SET `verified` = 1, `verified_on` = '2021-11-04 15:45:40'
WHERE `email_address` = 'Qari@9oclockshop.co.uk';
INSERT INTO `grocery_brand` (`BrandName`, `Alias`, `CreatedOn`, `Status`) VALUES ('Galaxy', 'Galaxy', '2021-11-06 14:06:26', 1);
INSERT INTO `grocery_brand` (`BrandName`, `Alias`, `CreatedOn`, `Status`) VALUES ('Galaxy2', 'Galaxy2', '2021-11-06 14:06:33', 1);
UPDATE `users` AS `a`,`user_login` AS `b` SET `a`.`first_name` = 'Qari', `a`.`email` = 'Qari@9oclockshop.co.uk', `a`.`last_name` = 'jee', `b`.`username` = 'Qari@9oclockshop.co.uk',`a`.`logo` = '' WHERE `a`.`user_id` = 'caa0e18c6d8dc6ab8f47' AND `a`.`user_id` = `b`.`user_id`;
