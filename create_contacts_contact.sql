CREATE TABLE contacts.contact(
    id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    email VARCHAR(255),
    context TEXT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);