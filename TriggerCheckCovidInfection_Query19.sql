DELIMITER $$
CREATE TRIGGER check_covid_infection
BEFORE INSERT ON Schedule
FOR EACH ROW
BEGIN
    DECLARE infected_date DATE;
    DECLARE emp_role VARCHAR(24);
    SELECT MAX(dateOfInfection), employeeRole INTO infected_date, emp_role
    FROM HasCaught
    JOIN Employee as e on HasCaught.employeeID = e.ID
    WHERE employeeID = NEW.employeeID
    AND dateOfInfection <= DATE_ADD(NEW.shiftStart, INTERVAL 14 DAY)
    AND e.employeeRole IN ('Nurse', 'Doctor')
    GROUP BY employeeID;
    IF infected_date IS NOT NULL AND NEW.shiftStart < DATE_ADD(infected_date, INTERVAL 2 WEEK) AND NEW.shiftEnd > infected_date THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot be scheduled to work for at least two weeks from the date of COVID-19 infection';
    END IF;
END$$
DELIMITER ;
