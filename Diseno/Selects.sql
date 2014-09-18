Use plavisoft;
alter table tipo_vivienda modify valor numeric(15,2);
alter table plavisoft.pago modify Importe numeric(15,2);
Select * From tipo_vivienda;

#Financiacion
Select * From plavisoft.financiacion;

update plavisoft.financiacion
set cant_cuotas = 24
where id>7;

# Tipo_Persona
Select * from plavisoft.tipo_persona;

# Tipo_Cuota
Select * from plavisoft.tipo_cuota;

#
Select * from plavisoft.estado_adjudicacion;

# Suscripciones
Select * from plavisoft.suscripcion;
delete from plavisoft.suscripcion where id<100;

Select * from plavisoft.pago;

Select * from plavisoft.planpago;

Select * from plavisoft.forma_pago;

Select * from plavisoft.tipo_vivienda;

# Cuota
Select * from plavisoft.cuota;
insert into plavisoft.cuota(suscripcion_id,nro_cuota,valor,valorLetras,mes_id,anio,saldada) values(21,1,2500,'dsad',1,2014,0); 
delete from plavisoft.cuota where id<100;

Select * from plavisoft.mes;


# Persona
Select * from plavisoft.persona;

Select 
	p.Apellido, t.descripcion, f.* 
from plavisoft.persona as p
join plavisoft.tipo_persona as t on t.id = p.tipo_persona_id
join plavisoft.financiacion as f on t.id = f.tipo_persona_id
order by p.id;


# Consulta que reune 
SELECT 
	f.descripcion,
	m.mes, c.anio, c.valor, c.saldada
FROM persona as p 
JOIN suscripcion as s ON p.id = s.persona_id
JOIN financiacion as f ON s.financiacion_id = f.id
JOIN cuota as c ON s.id = c.suscripcion_id
JOIN mes as m ON c.mes_id = m.id
ORDER BY s.id, c.anio, c.mes_id;