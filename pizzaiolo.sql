SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `addons` (
  `AddonID` int NOT NULL,
  `MenuID` int DEFAULT NULL,
  `AddonName` varchar(255) NOT NULL,
  `AddonPrice` decimal(10,2) NOT NULL,
  `CategoryID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `addons` (`AddonID`, `MenuID`, `AddonName`, `AddonPrice`, `CategoryID`) VALUES
(1, 1, 'Chicken', 35.00, 1),
(2, 1, 'Pepperoni', 35.00, 1),
(3, 1, 'Mozzarella Cheese', 25.00, 1),
(4, 1, 'Mushrooms', 20.00, 1),
(5, 1, 'Tomatoes', 20.00, 1),
(6, 2, 'Chicken', 35.00, 2),
(7, 2, 'Salami', 35.00, 2),
(8, 2, 'Mozzarella Cheese', 25.00, 2),
(9, 2, 'Mushrooms', 20.00, 2),
(10, 2, 'Sausage', 35.00, 2),
(11, 8, 'Chicken', 35.00, 3),
(12, 8, 'Shrimp', 50.00, 3),
(13, 8, 'Mozzarella Cheese', 25.00, 3),
(14, 8, 'Mushrooms', 20.00, 3),
(15, 8, 'Sausage', 35.00, 3),
(16, 9, 'Chicken', 35.00, 3),
(17, 9, 'Shrimp', 50.00, 3),
(18, 9, 'Mozzarella Cheese', 25.00, 3),
(19, 9, 'Mushrooms', 20.00, 3),
(20, 9, 'Sausage', 35.00, 3),
(21, 10, '6 pcs.', 149.00, 3),
(22, 10, '12 pcs.', 259.00, 3);

CREATE TABLE `admin_users` (
  `AdminID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` binary(60) DEFAULT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `admin_users` (`AdminID`, `Username`, `Password`, `Name`, `Email`) VALUES
(3, 'admin1', 0x24327924313024544849302f76566b544d35336f3953506c6233424a7533577469714c44674435673959493870584e78373643416c33487143797171, 'Admin1', 'admin123@gmail.com'),
(4, 'admin2', 0x243279243130244b6e612e664f4158454231743977642e6278732f33652e585a436c6b6f7975465344574f343947317a4e2f7475673033736a535557, 'Admin2', 'admin2@gmail.com'),
(5, 'admin3', 0x2432792431302459486e5732562e663463463571716565725a6d4a544f49543074636d784a46753256636d52426839343562546658567a4f75383561, 'Admin3', 'admin3@gmail.com');


CREATE TABLE `cart` (
  `CartID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `MenuID` int DEFAULT NULL,
  `AddonID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  `TotalPrice` decimal(10,2) NOT NULL,
  `Confirmation` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `cart` (`CartID`, `UserID`, `MenuID`, `AddonID`, `Quantity`, `TotalPrice`, `Confirmation`) VALUES
(56, 7, 1, NULL, 1, 399.00, 1),
(57, 7, 6, 9, 2, 538.00, 1),
(58, 7, 6, 10, 2, 573.00, 1),
(59, 7, 1, 2, 1, 434.00, 1),
(60, 7, 10, NULL, 2, 398.00, 1),
(61, 7, 13, NULL, 3, 117.00, 1),
(62, 9, 3, NULL, 1, 359.00, 1),
(63, 9, 1, NULL, 1, 399.00, 1),
(64, 9, 13, NULL, 1, 39.00, 1),
(65, 9, 8, NULL, 1, 229.00, 1),
(66, 7, 5, NULL, 1, 239.00, 1);


CREATE TABLE `categories` (
  `CategoryID` int NOT NULL,
  `CategoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'PIZZA'),
(2, 'PASTA'),
(3, 'APPETIZERS'),
(4, 'DRINKS');


CREATE TABLE `menu` (
  `MenuID` int NOT NULL,
  `CategoryID` int DEFAULT NULL,
  `MenuName` varchar(255) NOT NULL,
  `Description` text,
  `Price` decimal(10,2) NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `ImageURL2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `menu` (`MenuID`, `CategoryID`, `MenuName`, `Description`, `Price`, `ImageURL`, `ImageURL2`) VALUES
(1, 1, 'Pepperoni Pizza', 'Pepperoni pizza is an American pizza variety which includes one of the countrys most beloved toppings. Pepperoni is actually a corrupted form of peperoni (one “p”), which denotes a large pepper in Italian, but nowadays it denotes a spicy salami, usually made with a mixture of beef, pork, and spices.', 399.00, '16.10\\peporoni16.10.jpg', 'image\\peporoni.png'),
(2, 1, 'Fungji Pizza', 'At Fungji Pizza, we believe in quality. Our commitment to using fresh, locally-sourced ingredients ensures that every pizza is a masterpiece of taste and texture. Experience the difference that premium ingredients make in every slice.', 359.00, '16.10\\fungji16.10.jpg', 'image\\fungji2.png'),
(3, 1, 'Margherita Pizza', 'Indulge in the creaminess of the finest mozzarella, carefully selected to achieve the perfect melt. Each slice is a symphony of textures, as the cheese cascades over the pizza, creating a harmonious blend of richness and gooey goodness.', 359.00, '16.10\\margherita16.10.jpg', 'image\\margaher2.png'),
(4, 1, 'Caprese Pizza', 'At Fungji Pizza, we believe in quality. Our commitment to using fresh, locally-sourced ingredients ensures that every pizza is a masterpiece of taste and texture. Experience the difference that premium ingredients make in every slice.', 399.00, '16.10\\caprese16.10.jpg', 'image\\caprese2.png'),
(5, 2, 'Carbonara Spaghetti', 'Each plate of Carbonara Spaghetti at PIZZAIOLO is a labor of love, crafted with passion and a commitment to culinary excellence. We believe in preserving the authenticity of this classic dish, ensuring that every bite reflects the soul of Italian tradition.', 239.00, 'Pasta\\carbonara spaghetti.jpg', 'Pasta\\cabo3.png'),
(6, 2, 'Spaghetti Red Sauce', 'Join us for an evening of culinary delight and savor the simplicity of perfection with our Spaghetti in Red Sauce. Whether youre a pasta enthusiast or a first-time adventurer, this classic dish beckons you to indulge in the warmth of tradition.', 259.00, 'Pasta\\red.jpg', 'Pasta\\red2.png'),
(7, 2, 'Spaghetti Seafood', 'Our Spaghetti with Seafood is a celebration crafted for seafood enthusiasts and adventurous palates alike. Whether youre a devoted lover of the oceans treasures or a first-time explorer, this dish promises an unforgettable voyage for your taste buds.', 359.00, 'Pasta\\seafood1.jpg', 'Pasta\\Seafood.png'),
(8, 3, 'Caesar Salad', 'Delight in the nutty richness of aged Parmesan cheese, finely grated to perfection. Its savory notes infuse every leaf with a touch of indulgence, creating a harmonious balance that speaks to the heart of Caesar Salad tradition.', 229.00, 'salad\\ceasar1.jpg', 'salad\\caesar222.png'),
(9, 3, 'Greek Salad', 'Drizzle your Greek Salad with our house-made oregano-infused dressing. A fragrant blend of olive oil, lemon, and aromatic oregano, this dressing is the final touch that ties together the medley of flavors, promising a burst of Mediterranean sunshine in every bite.', 199.00, 'salad\\greek salad.jpg', 'salad\\GREEK.png'),
(10, 3, 'BBQ Chicken 6 pcs.', 'Experience the magic of caramelization as our BBQ Chicken undergoes the perfect balance of heat and time on the grill. \r\nThe result is a crispy, caramelized exterior that locks in the natural juices, creating a delightful texture that will have you coming back for more.', 199.00, 'salad\\bbq chick1.jpg', 'salad\\bbq chick2.png'),
(11, 4, 'Mineral Water 1L.', 'Whether youre indulging in a flavorful appetizer, a succulent main course, or a sweet dessert, our Mineral Water is the perfect hydration partner. Its neutral and \r\nrefreshing nature complements a variety of flavors, allowing you to fully appreciate the nuances of each bite.', 129.00, 'drinks\\Evian9.png', 'drinks\\EVIAN.png'),
(12, 4, 'Coke 355 mL.', 'The effervescent bubbles of Coca-Cola add a playful touch to your dining adventure. \r\nThe crisp sensation and lively fizz make each sip a moment of joy, turning every meal into a celebration.', 39.00, 'drinks\\coke.png', 'drinks\\coke.png'),
(13, 4, 'Sprite 355 mL.', 'Quench your thirst with the invigorating taste of Sprite. The lively blend of lemon and lime flavors creates a symphony of refreshment that cleanses your palate and enhances the flavors of your meal.', 39.00, 'drinks\\sprite.png', 'drinks\\sprite.png'),
(14, 4, 'Orange Fanta 355 mL.', 'Immerse yourself in the symphony of orange refreshment that only Orange Fanta can provide. The bold and bright citrus notes dance on your taste buds, creating an atmosphere of joy and excitement with every sip.', 39.00, 'drinks\\fanta.png', 'drinks\\fanta.png');


CREATE TABLE `users` (
  `UserID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` binary(60) DEFAULT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`) VALUES
(7, 'kiki', 0x243279243130244850324b767a76547a435644634859426370463446754541623739524f78364347694a372e626c507178615361707a68384251382e, 'test001@gmail.com'),
(9, 'test2', 0x24327924313024385370756b64576e66504f5956737652626a784d446536484d527357586b65502f2f736a59744661303069692e6f7649656f636a6d, 'test002@gmail.com'),
(10, 'test3', 0x243279243130244c786f6e782f386a30685178784e334164575a787965394b3955416f427767434b63346344676b504f4c2f57745973464c584c304f, 'test003@gmail.com');

ALTER TABLE `addons`
  ADD PRIMARY KEY (`AddonID`),
  ADD KEY `MenuID` (`MenuID`);

ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`AdminID`);

ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `AddonID` (`AddonID`);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`),
  ADD KEY `CategoryID` (`CategoryID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

ALTER TABLE `addons`
  MODIFY `AddonID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

ALTER TABLE `admin_users`
  MODIFY `AdminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `cart`
  MODIFY `CartID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

ALTER TABLE `categories`
  MODIFY `CategoryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `menu`
  MODIFY `MenuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

ALTER TABLE `users`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `addons`
  ADD CONSTRAINT `addons_ibfk_1` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`);

ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`AddonID`) REFERENCES `addons` (`AddonID`);

ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;
