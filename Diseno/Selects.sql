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
Select * from plavisoft.pago;
Select * from plavisoft.imputacion;
Select * from plavisoft.cuota where id=300;

insert into plavisoft.cuota(suscripcion_id,nro_cuota,valor,valorLetras,mes_id,anio,saldada) values(21,1,2500,'dsad',1,2014,0); 
delete from plavisoft.cuota where id=306;

Select * from plavisoft.mes;


# Persona
Select * from plavisoft.persona;

Select 
	p.Apellido, t.descripcion, f.* 
from plavisoft.persona as p
join plavisoft.tipo_persona as t on t.id = p.tipo_persona_id
join plavisoft.financiacion as f on t.id = f.tipo_persona_id
order by p.id;


# Consulta de suscripcion completa cuotas pagas e impagas
SELECT 
	p.Apellido, p.Nombre,
	s.id,
	f.descripcion,
	m.mes, c.anio, c.valor, c.saldada
FROM persona as p 
JOIN suscripcion as s ON p.id = s.persona_id
JOIN financiacion as f ON s.financiacion_id = f.id
JOIN cuota as c ON s.id = c.suscripcion_id
JOIN mes as m ON c.mes_id = m.id
ORDER BY s.id, c.anio, c.mes_id;






# Todas las financiaciones disponibles para una persona que tienen el mismo tipo de persona
SELECT * 
FROM financiacion f
where 
not exists(
	Select 1 from suscripcion
	where financiacion_id = f.id and persona_id = 10
)
and 
exists(
	Select 1 from persona p 
	where p.id = 10 and f.tipo_persona_id = p.tipo_persona_id  
);


Select * from plavisoft.cheque_runtime;

Select * from plavisoft.imputacion;


delete from plavisoft.cheque_runtime where id>0;
delete from plavisoft.imputacion where pago_id>0;
delete from plavisoft.cheque where id>0;
delete from plavisoft.cheque_runtime where id>0;
delete from plavisoft.forma_pago_pago where pago_id>0;
delete from plavisoft.pago where id>0;

Select SUM(valor) From imputacion group by cuota_id ;
Select * From imputacion;
select * from plavisoft.forma_pago_pago;
Select * from plavisoft.Log;

update cuota set saldada='No' where id>0;
update cuota set valor=1500 where id>0;

SELECT SUM(valor) as total FROM `imputacion` WHERE cuota_id=10;


Select * from plavisoft.cuota order by nro_cuota;

Select * from plavisoft.pago;
delete from plavisoft.pago where id>0;
delete from plavisoft.imputacion;
delete from plavisoft.forma_pago_pago;
delete from plavisoft.cheque;
Select * from plavisoft.pago p join plavisoft.cheque c on p.id = c.pago_id;
update plavisoft.cuota set saldada = 'No' ;

Select now();

Select 
 cs.id,
 cs.suscripcion_id,
 cs.valor,
 cs.totalSaldado,
 cs.valor - cs.totalSaldado as saldo
From (
	Select 
	 c.id,
	 c.suscripcion_id,
	 c.valor,
	 sum(IFNULL(i.valor,0))	as totalSaldado
	From plavisoft.cuota c
	left join plavisoft.imputacion i on c.id = i.cuota_id
	Group by c.id, c.suscripcion_id, c.valor
) as cs; 

Select * from plavisoft.tipo_vivienda;
update plavisoft.tipo_vivienda
set Descripcion = 'Monoambiente. 1 Dormitorio'
where id = 3;

Select * from plavisoft.financiacion;
update plavisoft.financiacion 
Set descripcion = 'C' 
where id = 11;

insert into plavisoft.financiacion(descripcion, tipo_vivienda_id, tipo_persona_id, cant_cuotas, posicion)
values('C', 3, 2, 24, 2);

Select * from plavisoft.cheque;




Select extract(MONTH From current_date());

Select 
	c.mes_id, 
	c.anio, 
	c.saldada,
	count(c.mes_id) as cantidad_cuotas, 
	sum(c.valor) as total_valor,
	sum(c.totalSaldado) as total_saldado,
	sum(c.saldo) as total_saldo
From plavisoft.view_cuota_saldo c
where
	c.anio <= Year(current_date())
	and c.mes_id < Month(current_date())
Group by c.anio, c.mes_id, c.saldada
Order By anio, mes_id;

