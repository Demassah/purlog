SELECT 
TYPE,
CASE TYPE
   WHEN '1' THEN 'Fast Moving'
   WHEN '2' THEN 'Slow Moving'
END AS type_lokasi,

STORAGE,
CASE STORAGE
   WHEN '1'  THEN 'Available'
   WHEN '2'  THEN 'Hold'
   WHEN '3'  THEN 'Damage'
END AS storage_lokasi,

STATUS,
CASE STATUS
   WHEN '1'  THEN 'Aktif'
   WHEN '0'  THEN 'Tidak Aktif'
END AS status_lokasi

FROM ref_lokasi