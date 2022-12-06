SELECT name, wanumber, cdate, ctime, countries.country_name, ad.agname, gender.gname, attitudes.level
FROM contacts
INNER JOIN
apps_countries as countries
ON contacts.nationality=countries.id
INNER JOIN
adgroup as ad
ON contacts.adgroup = ad.agid
INNER JOIN
gender
ON contacts.gender=gender.gid
INNER JOIN
attitudes
ON contacts.attitude=attitudes.id;
