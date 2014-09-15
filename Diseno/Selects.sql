Use plavisoft;
alter table tipo_vivienda modify valor numeric(15,2);
alter table plavisoft.pago modify Importe numeric(15,2);
Select * From tipo_vivienda;

#Financiacion
Select * From plavisoft.financiacion;

# Tipo_Cuota
Select * from plavisoft.tipo_cuota;

#
Select * from plavisoft.estado_adjudicacion;

# Suscripciones
Select * from plavisoft.suscripcion;

Select * from plavisoft.pago;

Select * from plavisoft.planpago;

Select * from plavisoft.forma_pago;

Select * from plavisoft.tipo_vivienda;