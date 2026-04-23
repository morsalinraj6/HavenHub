CREATE DATABASE IF NOT EXISTS havenhub;
USE havenhub;

DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS services;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(120) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('Guest', 'Staff', 'Admin') NOT NULL DEFAULT 'Guest',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(20) NOT NULL UNIQUE,
    type ENUM('AC', 'Non-AC') NOT NULL,
    category ENUM('Deluxe', 'Suite') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    status ENUM('Available', 'Occupied', 'Maintenance') NOT NULL DEFAULT 'Available',
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    guests INT NOT NULL DEFAULT 1,
    total_nights INT NOT NULL DEFAULT 1,
    status ENUM('Pending', 'Confirmed', 'Checked-In', 'Checked-Out', 'Cancelled') NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_bookings_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_bookings_room FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL,
    service_name VARCHAR(120) NOT NULL,
    cost DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_services_booking FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT NOT NULL UNIQUE,
    total_amount DECIMAL(10,2) NOT NULL,
    paid_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_payments_booking FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
);

-- Sample users (password for all sample accounts: password123)
INSERT INTO users (name, email, password, role) VALUES
('Admin User', 'admin@havenhub.test', '$2y$10$wrSZ6h9P88kMfe8Sx7s11OM8oXkMumZ5qX6Ch12yvDqOiiMHDL/zy', 'Admin'),
('Staff User', 'staff@havenhub.test', '$2y$10$wrSZ6h9P88kMfe8Sx7s11OM8oXkMumZ5qX6Ch12yvDqOiiMHDL/zy', 'Staff'),
('Guest User', 'guest@havenhub.test', '$2y$10$wrSZ6h9P88kMfe8Sx7s11OM8oXkMumZ5qX6Ch12yvDqOiiMHDL/zy', 'Guest');

INSERT INTO rooms (room_number, type, category, price, status, image) VALUES
('101', 'AC', 'Deluxe', 120.00, 'Available', 'https://images.unsplash.com/photo-1566665797739-1674de7a421a?q=80&w=1200&auto=format&fit=crop'),
('102', 'AC', 'Suite', 220.00, 'Available', 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=1200&auto=format&fit=crop'),
('103', 'Non-AC', 'Deluxe', 85.00, 'Occupied', 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=1200&auto=format&fit=crop'),
('104', 'AC', 'Suite', 260.00, 'Maintenance', 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?q=80&w=1200&auto=format&fit=crop'),
('105', 'Non-AC', 'Deluxe', 95.00, 'Available', 'https://images.unsplash.com/photo-1590490360182-c33d57733427?q=80&w=1200&auto=format&fit=crop');

INSERT INTO bookings (user_id, room_id, check_in, check_out, guests, total_nights, status) VALUES
(3, 1, '2026-04-25', '2026-04-28', 2, 3, 'Confirmed'),
(3, 2, '2026-05-02', '2026-05-05', 2, 3, 'Pending');

INSERT INTO services (booking_id, service_name, cost) VALUES
(1, 'Laundry', 15.00),
(1, 'Dinner Service', 35.00),
(2, 'Airport Pickup', 40.00);

INSERT INTO payments (booking_id, total_amount) VALUES
(1, 410.00),
(2, 700.00);
