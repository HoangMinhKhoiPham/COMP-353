CREATE EVENT weekly_schedule
    ON SCHEDULE EVERY 1 WEEK
        STARTS '2023-04-09 20:00:00' -- Today is Sunday
        -- STARTS CURRENT_TIMESTAMP -- for testing
        ENDS CURRENT_TIMESTAMP + INTERVAL 365 YEAR -- ends in 1 year for now
    DO
    -- drop procedures in here when it works
    -- INSERT INTO logTable(sender, receiver, email, subject, date) values ('test', 'receove', 'bodyddddd', 'subject', now());
    CALL `vbc353_4`.`sendEmails`();

DROP EVENT IF EXISTS weekly_schedule;