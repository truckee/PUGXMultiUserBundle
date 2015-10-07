CREATE TABLE admin (id INTEGER NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_880E0D76BF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE admin_outbox (id INTEGER NOT NULL, recipient INTEGER NOT NULL, message_type VARCHAR(255) DEFAULT NULL, user_type VARCHAR(255) DEFAULT NULL, oppId INTEGER DEFAULT NULL, orgId INTEGER DEFAULT NULL, function VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id));
CREATE TABLE event (id INTEGER NOT NULL, event VARCHAR(255) DEFAULT NULL, eventDate DATE DEFAULT NULL, location VARCHAR(45) DEFAULT NULL, starttime VARCHAR(10) DEFAULT NULL, personId INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_3BAE0AA7A20C4B1C FOREIGN KEY (personId) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE focus (id INTEGER NOT NULL, focus VARCHAR(45) DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id));
CREATE TABLE opp_skill (oppId INTEGER NOT NULL, skillId INTEGER NOT NULL, PRIMARY KEY(oppId, skillId), CONSTRAINT FK_402CB22889EA8E40 FOREIGN KEY (oppId) REFERENCES opportunity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_402CB228EDA4D49F FOREIGN KEY (skillId) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE opportunity (id INTEGER NOT NULL, oppName VARCHAR(66) DEFAULT NULL, add_date DATE DEFAULT NULL, lastUpdate DATETIME DEFAULT NULL, minAge INTEGER DEFAULT NULL, active BOOLEAN DEFAULT NULL, group_ok BOOLEAN DEFAULT NULL, expireDate DATE DEFAULT NULL, description CLOB DEFAULT NULL, orgId INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_8389C3D73A8AF33E FOREIGN KEY (orgId) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE org_focus (orgId INTEGER NOT NULL, focusId INTEGER NOT NULL, PRIMARY KEY(orgId, focusId), CONSTRAINT FK_9C8DB98B3A8AF33E FOREIGN KEY (orgId) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_9C8DB98B3308C119 FOREIGN KEY (focusId) REFERENCES focus (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE organization (id INTEGER NOT NULL, orgName VARCHAR(65) DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, state VARCHAR(50) DEFAULT NULL, zip VARCHAR(10) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, website VARCHAR(50) DEFAULT NULL, active BOOLEAN DEFAULT NULL, "temp" BOOLEAN NOT NULL, add_date DATETIME DEFAULT NULL, background BOOLEAN DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, areacode INTEGER DEFAULT NULL, PRIMARY KEY(id));
CREATE TABLE person (id INTEGER NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked BOOLEAN NOT NULL, expired BOOLEAN NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles CLOB NOT NULL, credentials_expired BOOLEAN NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, first_name VARCHAR(50) DEFAULT NULL, last_name VARCHAR(50) DEFAULT NULL, add_date DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id));
CREATE TABLE search (id INTEGER NOT NULL, focus_id INTEGER DEFAULT NULL, org_id INTEGER DEFAULT NULL, opp_id INTEGER DEFAULT NULL, skill_id INTEGER DEFAULT NULL, type VARCHAR(255) NOT NULL, date DATE NOT NULL, PRIMARY KEY(id), CONSTRAINT FK_B4F0DBA751804B42 FOREIGN KEY (focus_id) REFERENCES focus (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B4F0DBA7F4837C1B FOREIGN KEY (org_id) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B4F0DBA7438D405D FOREIGN KEY (opp_id) REFERENCES opportunity (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B4F0DBA75585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE skill (id INTEGER NOT NULL, skill VARCHAR(45) DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id));
CREATE TABLE staff (id INTEGER NOT NULL, orgId INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_426EF3923A8AF33E FOREIGN KEY (orgId) REFERENCES organization (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_426EF392BF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE vol_focus (volId INTEGER NOT NULL, focusId INTEGER NOT NULL, PRIMARY KEY(volId, focusId), CONSTRAINT FK_79573DA1F95C666E FOREIGN KEY (volId) REFERENCES volunteer (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_79573DA13308C119 FOREIGN KEY (focusId) REFERENCES focus (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE vol_skill (volId INTEGER NOT NULL, skillId INTEGER NOT NULL, PRIMARY KEY(volId, skillId), CONSTRAINT FK_45AA933FF95C666E FOREIGN KEY (volId) REFERENCES volunteer (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_45AA933FEDA4D49F FOREIGN KEY (skillId) REFERENCES skill (id) NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE TABLE volunteer (id INTEGER NOT NULL, receive_email BOOLEAN DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_5140DEDBBF396750 FOREIGN KEY (id) REFERENCES person (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE);
CREATE INDEX IDX_3BAE0AA7A20C4B1C ON event (personId);
CREATE INDEX IDX_402CB22889EA8E40 ON opp_skill (oppId);
CREATE INDEX IDX_402CB228EDA4D49F ON opp_skill (skillId);
CREATE INDEX IDX_426EF3923A8AF33E ON staff (orgId);
CREATE INDEX IDX_45AA933FEDA4D49F ON vol_skill (skillId);
CREATE INDEX IDX_45AA933FF95C666E ON vol_skill (volId);
CREATE INDEX IDX_79573DA13308C119 ON vol_focus (focusId);
CREATE INDEX IDX_79573DA1F95C666E ON vol_focus (volId);
CREATE INDEX IDX_8389C3D73A8AF33E ON opportunity (orgId);
CREATE INDEX IDX_9C8DB98B3308C119 ON org_focus (focusId);
CREATE INDEX IDX_9C8DB98B3A8AF33E ON org_focus (orgId);
CREATE INDEX IDX_B4F0DBA7438D405D ON search (opp_id);
CREATE INDEX IDX_B4F0DBA751804B42 ON search (focus_id);
CREATE INDEX IDX_B4F0DBA75585C142 ON search (skill_id);
CREATE INDEX IDX_B4F0DBA7F4837C1B ON search (org_id);
CREATE UNIQUE INDEX UNIQ_34DCD17692FC23A8 ON person (username_canonical);
CREATE UNIQUE INDEX UNIQ_34DCD176A0D96FBF ON person (email_canonical);
