CREATE TABLE events (
    event_id SERIAL PRIMARY KEY,
    event_name VARCHAR(100) NOT NULL,
    event_date DATE NOT NULL,
    event_address VARCHAR(100) NOT NULL
);

CREATE TABLE participants (
    participant_id SERIAL PRIMARY KEY,
    event_id INT,
    participant_name VARCHAR(100) NOT NULL

    CONSTRAINT fk_event_p
        FOREIGN KEY (event_id)
        REFERENCES participants(event_id)

);

CREATE TABLE registrations (
    registration_id SERIAL PRIMARY KEY,
    event_id INT,
    participant_id INT,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_participant
        FOREIGN KEY (participant_id)
        REFERENCES participants(participant_id),

    CONSTRAINT fk_event
        FOREIGN KEY (event_id)
        REFERENCES events(event_id)
);