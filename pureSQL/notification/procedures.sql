use vbc353_4;
drop procedure if exists create_mail;
drop procedure if exists handle_facility;
drop procedure if exists handle_day;

delimiter //
create procedure handle_day(
    IN emp_id int, IN x int,
    INOUT emailList varchar(4000)
)
begin
    declare monday date default (date(NOW() + interval 1 day));
    declare sunday date default (date(NOW() + interval 6 day));
    declare emp_id int;
    declare employee_FN varchar(50);
    declare employee_LN varchar(50);
    declare employee_email varchar(50);
    declare facility_name varchar(50);
    declare facility_address varchar(50);
    declare email_body varchar(255);
    declare finished int default 0;
    declare the_day date;
    declare le_start_time time;
    declare le_end_time time;
    declare currentDay date default (monday);

    declare cursor_name cursor for
        select employeeID, firstName, lastName, email, facilityName, Day, start_time, end_time from
            (select employeeID, Date(shiftStart) as Day, time(shiftStart) as start_time, time(shiftEnd) as end_time, facilityName
             from Facilities join Schedule S on Facilities.id = S.facilityID
             where date(shiftStart) >= monday and date(shiftEnd) <= sunday and employeeID = emp_id
            ) as  week join Employee E on employeeID = E.ID order by employeeID, facilityName, Day;

    declare continue handler for not found set finished = 1;

    open cursor_name;

    SET emailList = CONCAT('Schedule for ', employee_FN, ' ', employee_LN, ' at ',  facility_name, '(', facility_address, ')\n', emailList);

    getDays: LOOP
        FETCH cursor_name INTO emp_id, employee_FN, employee_LN, employee_email, facility_name, the_day, le_start_time, le_end_time;
        IF finished = 1 THEN
            LEAVE getDays;
        END IF;
        -- build email list
        IF date(currentDay) = date(the_day) THEN
            SET emailList = CONCAT(currentDay, ' ', day(currentDay), ': ',  'start: ', le_start_time, ' end: ', le_end_time, '\n', emailList);
            ELSE SET emailList = CONCAT(currentDay, ' ', day(currentDay), ': ', 'No Assignment\n',  emailList);
        END IF;

        set currentDay = currentDay + interval 1 day;


    END LOOP getDays;
    INSERT INTO logTable(emailID, sender, receiver, email, subject, date) values (x, 'test', 'receive', emailList, 'subject', now());
    close cursor_name;


end;
create procedure handle_facility(
    IN emp_id int,
    INOUT emailList varchar(4000)
)
begin
    declare monday date default (date(NOW() + interval 1 day));
    declare sunday date default (date(NOW() + interval 6 day));
    declare emp_id int;
    declare employee_FN varchar(50);
    declare employee_LN varchar(50);
    declare employee_email varchar(50);
    declare facility_name varchar(50);
    declare facility_address varchar(50);
    declare email_body varchar(255);
    declare finished int default 0;
    declare the_day date;
    declare le_start_time time;
    declare le_end_time time;
    declare x int default 1000; -- hardcoded for now since we dont have autoincrement.

    declare cursor_name cursor for
        select employeeID, firstName, lastName, email, facilityName, Day, start_time, end_time from
            (select employeeID, Date(shiftStart) as Day, time(shiftStart) as start_time, time(shiftEnd) as end_time, facilityName
             from Facilities join Schedule S on Facilities.id = S.facilityID
             where date(shiftStart) >= monday and date(shiftEnd) <= sunday and employeeID = emp_id
            ) as  week join Employee E on employeeID = E.ID order by employeeID, facilityName, Day;

    declare continue handler for not found set finished = 1;

    open cursor_name;

    getSchedule: LOOP
        FETCH cursor_name INTO emp_id, employee_FN, employee_LN, employee_email, facility_name, the_day, le_start_time, le_end_time;
        IF finished = 1 THEN
            LEAVE getSchedule;
        END IF;
        call handle_day(emp_id, x, emailList);
        set x = x +1;


    END LOOP getSchedule;

    close cursor_name;
end;


create procedure create_mail(
    INOUT emailList varchar(4000)
)
begin
    declare monday date default (date(NOW() + interval 1 day));
    declare sunday date default (date(NOW() + interval 6 day));
    declare emp_id int;
    declare employee_FN varchar(50);
    declare employee_LN varchar(50);
    declare employee_email varchar(50);
    declare facility_name varchar(50);
    declare facility_address varchar(50);
    declare email_body varchar(255);
    declare finished int default 0;
    DECLARE emailAddress varchar(100) DEFAULT '';
    declare the_day date;
    declare le_start_time time;
    declare le_end_time time;

    declare cursor_name cursor for
        select employeeID, firstName, lastName, email, facilityName, Day, start_time, end_time from
            (select employeeID, Date(shiftStart) as Day, time(shiftStart) as start_time, time(shiftEnd) as end_time, facilityName
             from Facilities join Schedule S on Facilities.id = S.facilityID
             where date(shiftStart) >= monday and date(shiftEnd) <= sunday
            ) as  week join Employee E on employeeID = E.ID order by employeeID, facilityName, Day;

    declare continue handler for not found set finished = 1;

    open cursor_name;

    getID: LOOP
        FETCH cursor_name INTO emp_id, employee_FN, employee_LN, employee_email, facility_name, the_day, le_start_time, le_end_time;
        IF finished = 1 THEN
            LEAVE getID;
        END IF;
        call handle_facility(emp_id, emailList);

        -- SET emailList = CONCAT(employee_email,'; ',emailList);
    END LOOP getID;

    close cursor_name;
    -- set email_body = employee_FN + employee_LN;
    -- INSERT INTO logTable(sender, receiver, email, subject, date) values ('test', 'receove', email_body, 'subject', now());
end;
delimiter ;

SET @emailList = '11';
CALL create_mail(@emailList);
SELECT @emailList;