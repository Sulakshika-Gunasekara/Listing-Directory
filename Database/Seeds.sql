-- Kiptra Sri Lanka - Database Seeds

-- Users
INSERT INTO `users` (`name`, `email`, `role`, `verified`) VALUES
('Admin User', 'admin@kiptra.com', 'Admin', 1),
('Vendor User', 'vendor@kiptra.com', 'Vendor', 1),
('Regular User', 'user@kiptra.com', 'User', 1);

-- Categories
INSERT INTO `categories` (`name`, `icon`, `parent_id`) VALUES
('SIM & Connectivity', 'wifi', NULL),
('Health & Safety', 'heart', NULL),
('Food & Drink', 'utensils', NULL),
('Transport', 'car', NULL),
('Stay', 'home', NULL);

-- Subcategories
INSERT INTO `categories` (`name`, `icon`, `parent_id`) VALUES
('Vegan Cafes', 'leaf', 3),
('Local Markets', 'store', 3),
('Fine Dining', 'glass-cheers', 3);

-- Listings
INSERT INTO `listings` (`title`, `description`, `category_id`, `location`, `contact_info`) VALUES
('Dialog SIM Card Kiosk', 'Get your local SIM card at the airport.', 1, 'Bandaranaike International Airport', '+94 77 712 3456'),
('Asiri Health', '24/7 emergency services and pharmacy.', 2, 'Colombo', '+94 11 234 5678'),
('Nuga Gama', 'Authentic Sri Lankan cuisine in a village setting.', 3, 'Colombo', '+94 11 249 7372'),
('PickMe', 'Ride-hailing app for taxis and tuk-tuks.', 4, 'Islandwide', 'support@pickme.lk'),
('Cinnamon Grand Colombo', 'Luxury hotel in the heart of the city.', 5, 'Colombo', '+94 11 243 7437');
