CREATE SCHEMA IF NOT EXISTS uilogs;

CREATE TABLE IF NOT EXISTS uilogs.logs (
    LogID SERIAL PRIMARY KEY,
    Timestamp TIMESTAMP NOT NULL,
    Level VARCHAR(10) NOT NULL,
    Source VARCHAR(255) NOT NULL,
    UserID VARCHAR(70),
    EventType VARCHAR(100),
    Message TEXT,
    IPAddress VARCHAR(15),
    SessionID VARCHAR(50),
    AdditionalData JSON
    );

-- DEBUG, INFO, WARN, ERROR, FATAL

INSERT INTO uilogs.logs (Timestamp, Level, Source, UserID, EventType, Message, IPAddress, SessionID, AdditionalData)
VALUES (
           NOW(),                     -- Current timestamp
           'ERROR',                   -- Log level
           'UserModule',              -- Source of the log
           '12345',                   -- User ID
           'LoginAttempt',            -- Type of event
           'Failed login attempt',    -- Message describing the event
           '192.168.1.1',             -- IP address from where the action was performed
           'session123',              -- Session ID
           '{"additionalInfo": "Details about the login attempt"}'::json  -- Additional data in JSON format
       );