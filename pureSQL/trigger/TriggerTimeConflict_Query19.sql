DELIMITER $$
CREATE TRIGGER Time_Conflict AFTER INSERT ON Schedule FOR EACH ROW BEGIN
    DECLARE shift_count INT;
    DECLARE overlap_count INT;
    SET shift_count = (SELECT COUNT(*) FROM Schedule WHERE employeeID = NEW.employeeID AND DATE(shiftStart) = DATE(NEW.shiftStart));
    IF shift_count > 1 THEN
        SET overlap_count = (select count(*) from Schedule s1 join Schedule s2 on s1.employeeID = s2.employeeID and DATE(s1.shiftStart) = DATE(s2.shiftStart) and s1.shiftStart < s2.shiftStart and (s2.shiftStart - s1.shiftEnd) < 1);
        IF overlap_count > 0  THEN
            signal SQLSTATE '45000 set MESSAGE_TEXT = ‘TIME CONFLICT’'; 
        END IF;
    END IF;
END$$
DELIMITER ;
