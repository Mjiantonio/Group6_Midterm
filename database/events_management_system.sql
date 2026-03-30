-- TABLE: events
CREATE TABLE events (
    event_id SERIAL PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLE: participants
CREATE TABLE participants (
    participant_id SERIAL PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLE: registrations
CREATE TABLE registrations (
    registration_id SERIAL PRIMARY KEY,
    event_id INT NOT NULL,
    participant_id INT NOT NULL,
    registration_date DATE NOT NULL,
    status VARCHAR(50) DEFAULT 'registered',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (event_id) REFERENCES events(event_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (participant_id) REFERENCES participants(participant_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- INSERT EVENTS
INSERT INTO events (event_name, event_date, location, description)
VALUES 
('Group Dynamics 2026', '2026-03-13', 'Cuyab, Pansol', 'Team Building event'),
('Tech Talk 2026', '2026-03-11', 'CCC, Calamba', 'Inspirational Talk event'),
('Sports Fest 2026', '2026-04-06', 'Cine De Calamba', 'Sports Festival event'),
('Peer Coding', '2026-04-03', 'Online Meeting', 'Collaboration event');

-- INSERT PARTICIPANTS
INSERT INTO participants (full_name, email, phone)
VALUES
('Mark Justine Antonio', 'mark.antonio@gmail.com', '09123456781'),
('Ailecsis Alron Arl Austria', 'ailecsis.austria@gmail.com', '09123456782'),
('Gerald Dimaunahan', 'gerald.dimaunahan@gmail.com', '09123456783'),
('Hannah Nicole Macrohon', 'hannah.macrohon@gmail.com', '09123456784'),
('Hugh Daniel Raymundo', 'hugh.raymundo@gmail.com', '09123456785'),
('Judandrew Rivas', 'judandrew.rivas@gmail.com', '09123456786');

-- INSERT REGISTRATIONS
INSERT INTO registrations (event_id, participant_id, registration_date, status)
VALUES
(1, 1, '2026-03-01', 'registered'),
(1, 2, '2026-03-01', 'registered'),
(2, 3, '2026-03-05', 'registered'),
(2, 4, '2026-03-05', 'registered'),
(3, 5, '2026-03-20', 'registered'),
(4, 6, '2026-03-25', 'registered'),
(3, 1, '2026-03-22', 'registered'),
(4, 2, '2026-03-26', 'registered');