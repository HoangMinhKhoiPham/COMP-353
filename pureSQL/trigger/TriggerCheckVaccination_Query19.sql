DELIMITER $$
CREATE TRIGGER check_vaccination
BEFORE INSERT ON Schedule
FOR EACH ROW
BEGIN
    DECLARE last_vaccine_date DATE;
    SET last_vaccine_date = (
        SELECT MAX(dateOfVaccination)
        FROM hasTaken
        WHERE employeeID = NEW.employeeID
        AND dateOfVaccination >= DATE_SUB(NEW.shiftStart, INTERVAL 6 MONTH)
    );
    IF last_vaccine_date IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Employee is not vaccinated';
    END IF;
END$$
DELIMITER ;
