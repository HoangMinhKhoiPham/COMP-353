DELIMITER $$
CREATE TRIGGER limit_schedule_insert
BEFORE INSERT ON Schedule
FOR EACH ROW
BEGIN
    IF NEW.shiftStart > ADDDATE(NOW(), INTERVAL 4 WEEK) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Shift start date is too far in the future';
    END IF;
END$$
DELIMITER 
