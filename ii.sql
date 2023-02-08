-- ii
select province, facilityType, count(*) as c
from facilities
group by facilityType, province
order by province, c;
