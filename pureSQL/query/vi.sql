-- vi
-- version 1 - since a vaccine is only added to the table if it was given to someone, then you only need to count them from vaccine
select vaccineType, count(*) as c from vaccines group by vaccineType order by c DESC;
