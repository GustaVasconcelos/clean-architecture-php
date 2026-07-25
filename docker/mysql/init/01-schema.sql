CREATE TABLE IF NOT EXISTS registrations (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    registration_number CHAR(11) NOT NULL,
    birth_date DATE NOT NULL,
    registration_at DATETIME NOT NULL,
    UNIQUE KEY uk_registrations_registration_number (registration_number)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO registrations (name, email, registration_number, birth_date, registration_at)
VALUES (
    'Gustavbo Vasconcelos',
    'gustavbo.vasconcelos@example.com',
    '52998224725',
    '1995-03-15',
    '2026-07-23 15:43:00'
)
ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    email = VALUES(email),
    birth_date = VALUES(birth_date),
    registration_at = VALUES(registration_at);
