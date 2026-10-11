select *
from plan_details;

select *
from unit_prices;

SELECT id, plan_id, plan_date, volume
FROM plan_details
ORDER BY id DESC
LIMIT 20;
